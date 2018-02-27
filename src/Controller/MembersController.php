<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class MembersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function initialize() {
        parent::initialize();
        //管理者Auth
        $this->loadComponent("Auth",[
          'authorize'=>['Controller'],
          'authenticate'=>[
            'Form'=>[
              'userModel'=>'Users',
              'fields'=>[
                'username'=>'username',
                'password'=>'password'
              ]
            ]
          ],
          'loginAction'=>[
              'controller'=>'Members',
              'action'=>'login'
          ],
          'loginRedirect'=>[
                'controller'=>'Members',
                'action'=>'index'
            ],
            'logoutRedirect'=>[
                'controller'=>'Members',
                'action'=>'login'
            ],
          'authError'=>'ログインしてください。',
        ]);
        $this->Auth->sessionKey = 'Auth.Member';
       
         $this->viewBuilder()->setLayout('member');
         
         $this->Category = TableRegistry::get('Categories');
         $categories = $this->Category->find()->all();
         $category = [];
         foreach($categories as $v){
             $category[$v['id']]=$v[ 'name' ];
         }
         
         $magaginetitle = [];
         $this->Magazinetitles = TableRegistry::get('Magazinetitles');
         $this->Users = TableRegistry::get("Users");
        $magaginetitles = $this->Magazinetitles->find( 'all' );
        $magaginetitle[0] = "連載投稿するタイトルを選択してください。";
        foreach($magaginetitles as $v){
             $magaginetitle[$v['id']]=$v[ 'title' ];
         }
         
         $this->MagazineGroup= TableRegistry::get("Magaginegroups");
         $this->MagazineData = TableRegistry::get("Magazinedatas");
         
        $userid = $this->Auth->user("id");
        $comictitle = $this->Members->find('all',[
            'group'=>['Members.id']
        ]);
        $comictitle->select([
                    'title'=>'Members.title',
                    'id'=>'Members.id',
                    'note'=>'Members.note',
                    'status'=>'Members.status',
                    'totalgroup'=>$comictitle->func()->count('magaginegroups.id') ])
                    ->contain(['magaginegroups','users'])
                    ->where([
                            'Members.user_id'=>$userid,
                            ])
                ->order([
                    'magaginegroups.magaginetitle_id'=>"DESC" ,
                    'Members.modified'=>"DESC"
                    ])
                ->toArray();

        $this->set("comictitle",$comictitle);
         
        $this->set("authid",$this->Auth->user("id"));
        $this->set("category",$category);
        $this->set("magaginetitle",$magaginetitle);
        $this->set("code",$this->Auth->user("code"));
        $this->set("open",false);
        
    }
    public function index()
    {
        $userid = $this->Auth->user("id");
        
        $group = $this->MagazineGroup->find('all',[
            'group'=>['Magaginegroups.magaginetitle_id']
        ]);

        $group->select([
                'Magaginegroups.id',
                'Magaginegroups.magaginetitle_id',
                'totalgroup'=>$group->func()->count('Magaginegroups.magaginetitle_id') 
                ])
            ->innerJoin(
                    ['magazinetitles'=>'magazinetitles'],
                    ['magazinetitles.id=Magaginegroups.magaginetitle_id']
                    )
            ->where(
                    [
                        'magazinetitles.user_id'=>$userid,
                        'Magaginegroups.status'=>1
                    ])->toArray();
         

         $groups = [];
         foreach($group as $val){
             $groups[$val[ 'magaginetitle_id' ]] = $val[ 'totalgroup' ];
         }
         
        $this->set("groups",$groups);
    }
    
    public function changeTitleStatus($id = null){
        if($this->request->isPost()){
            $title = $this->Members->get($id, [
                'contain' => []
            ]);
            $title->status = $this->request->data("status");
            $title->modified = time();
            $this->Members->save($title);
        }
        
        exit();
    }
    
    public function changeGroupStatus($id = null){
        if($this->request->isPost()){
            $title = $this->MagazineGroup->get($id, [
                'contain' => []
            ]);
            $title->status = $this->request->data("status");
            $title->modified = time();
            $this->MagazineGroup->save($title);
        }
        
        exit();
    }
    
    public function create(){
        //連載の時
        if($this->request->data("createtype") == "serial"){
            $magaginetitle_id  = $this->request->data("magaginetitle_id");
            if(!$magaginetitle_id){
                return $this->redirect("/member/");
            }
            return $this->redirect("/members/create2/".$magaginetitle_id);
        }
        
        $mag = $this->Magazinetitles->newEntity();
        if($this->request->isPost()){
            $mag = $this->Magazinetitles->patchEntity($mag, $this->request->getData());
            $mag->user_id = $this->Auth->user("id");
            $mag->created = time();
            $mag->modified = time();
            if ($save = $this->Magazinetitles->save($mag)) {
                $code = $this->Auth->user("code");
                
                $this->makeDirectory($code,$save->id,"title");
                $this->makeDirectory($code,$save->id,"data");
                return $this->redirect("/members/create2/".$save->id);
            }
        }
    }
    
    public function getTitleData(){
        $magaginetitle_id = $this->request->data("magaginetitle_id");
        $magazinedata = $this->Members
                ->find('all')
                 ->contain(['categories'])
                ->where([
                    'Members.user_id'=>$this->Auth->user("id")
                        ,'Members.id'=>$magaginetitle_id
                        ])
                ->toArray();
        
        header('Content-Type: application/json');
        echo json_encode( $magazinedata );

        exit();
    }
    
    public $components = array('File');
    public function create2($id = null){

        if($id > 0){
            //データチェック
            $userid = $this->Auth->user("id");
            
            $data = $this->Members->find()
                    ->where([
                            'id'=>$id,
                            'user_id'=>$userid
                            ])->toArray();

            if(!$data){
                return $this->redirect("/members/create/");
            }
            if ($this->request->is('post')) {
                $mag = $this->MagazineGroup->newEntity();
                $mag = $this->MagazineGroup->patchEntity($mag, $this->request->getData());

               $number = $this->getGroupMaxNumber($id);
                $mag->created = time();
                $mag->modified = time();
                $mag->user_id = $userid;
                $mag->magaginetitle_id = $id;
                $mag->number=$number;
                if ($save = $this->MagazineGroup->save($mag)) {
                    $code = $this->Auth->user("code");
                    $this->makeDirectory($code,$id,"title",$save->id);
                    //画像の移動
                    $frompath = WWW_ROOT."comics/".$code."/".$id."/title/".$this->request->data('filename');
                    $topath = WWW_ROOT."comics/".$code."/".$id."/title/".$save->id."/".$this->request->data('filename');
                    $this->moveImage($frompath,$topath);
                    $frompath = WWW_ROOT."comics/".$code."/".$id."/title/s_".$this->request->data('filename');
                    $topath = WWW_ROOT."comics/".$code."/".$id."/title/".$save->id."/s_".$this->request->data('filename');
                    $this->moveImage($frompath,$topath);
                    return $this->redirect("/members/create3/".$id."/".$save->id);
                }
                return $this->redirect("/members/create/");
            }
        }else{
            return $this->redirect("/members/create/");
        }
        
        $this->set("titleid",$id);
    }
    
    public function create3($id = null,$gid=null){
        if ($this->request->is('post')) {
                        
            $image = $this->request->data("image");
            if(count($image)){
                $insert = [];
                $num = 1;
                foreach($image as $key=>$val){
                    $insert[ $key ][ 'user_id' ] = $this->Auth->user("id");
                    $insert[ $key ][ 'number' ] = $num;
                    $insert[ $key ][ 'magazinetitle_id' ] = $id;
                    $insert[ $key ][ 'magazinegroup_id' ] = $gid;
                    $insert[ $key ][ 'filename' ] = $val;
                    $insert[ $key ][ 'created' ] = time();
                    $insert[ $key ][ 'modified' ] = time();
                    $num++;
                }
                
            }
            
            $entities = $this->MagazineData->newEntities($insert);
            foreach ($entities as $entity) {
                // Save entity
                $this->MagazineData->save($entity);
            }
            $code = $this->Auth->user("code");
            $this->makeDirectory($code,$id,"data",$gid);
            
           // var_dump($_REQUEST);
            
            if(count($image)){
                foreach($image as $key=>$val){
                    //画像の移動
                    $frompath = WWW_ROOT."comics/".$code."/".$id."/data/".$val;
                    $topath = WWW_ROOT."comics/".$code."/".$id."/data/".$gid."/".$val;
                    $this->moveImage($frompath,$topath);
                    
                    $frompath = WWW_ROOT."comics/".$code."/".$id."/data/s_".$val;
                    $topath = WWW_ROOT."comics/".$code."/".$id."/data/".$gid."/s_".$val;
                    $this->moveImage($frompath,$topath);
                }                
            }
            $path = WWW_ROOT."comics/".$code."/".$id."/data/";
            $this->deleteImageFile($path);

            $this->Flash->success(__('登録を行いました。'));
            return $this->redirect(['action' => '../members/']);
            
        }
        $this->set("titleid",$id);
        $this->set("groupid",$gid);

    }
    
    public function getGroupMaxNumber($id){
        
        $grp = $this->MagazineGroup->find('all')
                ->select([ 'number' ])
                ->where(['magaginetitle_id'=>$id])
                ->max('number');

         $num = sprintf("%d",$grp[ 'number' ]+1);
        return $num;
    }
    
    public function getDataMaxNumber($id){
        
        $grp = $this->MagazineData->find('all')
                ->select([ 'number' ])
                ->where(['magazinegroup_id'=>$id])
                ->max('number');
         $num = sprintf("%d",$grp[ 'number' ]+1);
        return $num;
    }
    
    public function getMagazineData($id = null){
        $magazinedata = $this->MagazineData
                ->find('all')
                ->where([
                    'user_id'=>$this->Auth->user("id")
                        ,'magazinegroup_id'=>$id
                        ])
                ->order("number ASC")
                ->toArray();
        header('Content-Type: application/json');
        echo json_encode( $magazinedata );
    
        exit();
    }
    
    public function changeSort($id){
        
       $num = $this->request->data("num");

       if(count($num) > 0){
          // $mag = $this->MagazineData->newEntity();
           $order = 1;
            foreach($num as $key=>$val){
                
                $data = [
                    'number'=>$order
                ];
                $conditions = [
                    'id'=>$val,
                    'magazinegroup_id'=>$id,
                    'user_id'=>$this->Auth->user("id")
                ];
                $this->MagazineData->updateAll($data,$conditions);
                $order++;
            }
       }
       exit(); 
    }
    
    //$third: titleid
    public function editFileupload($grpid = 0,$second="",$id=''){
        //タイトルIDの取得
        $grp = $this->MagazineGroup
                        ->find()
                        ->select(['magaginetitle_id'])
                        ->where(['id'=>$grpid])
                        ->toArray();
        
        
        $user = $this->Auth->user();
        $file = $this->request->data['image'];
        $dir = "";
        //タイトル画像の変更
        if($second == "titleimageEdit"){
            $dir = WWW_ROOT."comics/".$user[ 'code' ]."/";
        }
        //内容の時
        if($second == "notes"){
            $dir = WWW_ROOT."comics/".$user[ 'code' ]."/".$grpid."/";
        }
        
        
        $filename = $this->File->fileuploads($file,$dir);

        if($second == "titleimageEdit"){ 
            $data = [ 'topfilename'=>$filename]; 
            $conditions = [
                'id'=>$grp[0][ 'magaginetitle_id' ],
                'user_id'=>$this->Auth->user("id"),
            ];
            $this->Magazinetitles->updateAll($data,$conditions);
        }
        if($second == "notes"){ 
            $filename = "/comics/".$user[ 'code' ]."/".$grpid."/".$filename;
            $data = [ 'filename'=>$filename]; 
            $conditions = [
                'id'=>$id,
                'magazinegroup_id'=>$grpid,
                'user_id'=>$this->Auth->user("id")
            ];
            $this->MagazineData->updateAll($data,$conditions);
        }
        
        header('Content-Type: application/json');
        //タイトル画像の変更
        if($second == "titleimageEdit"){
            echo json_encode( "/comics/".$user[ 'code' ]."/".$filename );
        }
        if($second == "notes"){
            echo json_encode( $filename );
        }
        exit();
    }
    
    
    public function titlefileupload($id=0){
        $file = $this->request->data['image'];
        $user = $this->Auth->user();
        //タイトル
        $code = $user[ 'code' ];
        $dir = "/comics/".$code."/".$id."/title/";
        $pathdir = WWW_ROOT.$dir;
        $filename = $this->File->fileuploads($file,$pathdir);        
        header('Content-Type: application/json');
        $return[ 'filepath' ] = $dir.$filename;
        $return[ 'filename' ] = $filename;
        echo json_encode( $return );
        exit();
    }
    public function fileupload($titleid=0,$groupid=0){
        $file = $this->request->data['image'];
        $user = $this->Auth->user();
        //タイトル
        $code = $user[ 'code' ];
        $dir = "/comics/".$code."/".$titleid."/data/";
        $pathdir = WWW_ROOT.$dir;
        $filename = $this->File->fileuploads($file,$pathdir);        
        header('Content-Type: application/json');
        $return[ 'filepath' ] = $dir.$filename;
        $return[ 'filename' ] = $filename;
        echo json_encode( $return );
        exit();
    }
    
    public function login(){
        if($this->request->isPost()){
            $user = $this->Auth->identify();
            if(!empty($user)){
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ユーザー名かパスワードが間違っています。');
        }
    }
    public function logout(){
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }
    
    public function editText($grpid = ""){
         if ($this->request->is('post')) {
             $text = $this->request->data("text");
             
            $grp = $this->MagazineGroup
                       ->find()
                       ->select(['magaginetitle_id'])
                       ->where(['id'=>$grpid])
                       ->toArray();
             switch($this->request->data("type")){
                 case "info":
                     $data = [ 'note'=>$text];
                     $conditions = [
                           'id'=>$grp[0][ 'magaginetitle_id' ],
                           'user_id'=>$this->Auth->user("id")
                       ];
                       $this->Magazinetitles->updateAll($data,$conditions);
                     break;
                 case "category":
                     $data = [ 'category_id'=>$text];
                     $conditions = [
                           'id'=>$grp[0][ 'magaginetitle_id' ],
                           'user_id'=>$this->Auth->user("id")
                       ];
                       $this->Magazinetitles->updateAll($data,$conditions);
                     break;
                 case "title":
                        $data = [ 'title'=>$text];
                        $conditions = [
                           'id'=>$grp[0][ 'magaginetitle_id' ],
                           'user_id'=>$this->Auth->user("id")
                       ];
                       $this->Magazinetitles->updateAll($data,$conditions);
                  break;
             }
             exit();
        }
    }
    
    

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        
        $this->Auth->allow(['login']);
    }
    public function isAuthorized($user = null){
        $action = $this->request->params[ 'action' ];

        if($user[ 'role' ] == "custom"){
            return true;
        }
        return false;
    }    
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function titleedit($id = null)
    {
        $member = $this->Members->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $member = $this->Members->patchEntity($member, $this->request->getData());
            if($this->request->data("title")){ $member->title = $this->request->data("title"); }
            $member->category_id = $this->request->data("category_id");
            $member->note = $this->request->data("note");
            $member->modified = time();
            if ($this->Members->save($member)) {
                $this->Flash->success(__('編集に成功しました'));
                return $this->redirect(['action' => '../members/']);
            }
            $this->Flash->error(__('編集に失敗しました'));
        }
        $this->set("member",$member);
    }
    public function edit($id = null){
         $userid = $this->Auth->user("id");
         $group = $this->MagazineGroup
                        ->find()
                        ->select([
                            'Magaginegroups.filename',
                            'Magaginegroups.name',
                            'Magaginegroups.note',
                            'Magaginegroups.magaginetitle_id',
                            'Magaginegroups.id',
                            'Magaginegroups.status',
                            'users.code'
                            ])
                        ->innerJoin(
                                ['magazinetitles'=>'magazinetitles'],
                                ['magazinetitles.id=Magaginegroups.magaginetitle_id']
                                )
                        ->innerJoin(
                                ['users'=>'users'],
                                ['magazinetitles.user_id=users.id']
                                )
                        ->where(
                                ['magazinetitles.user_id'=>$userid,
                                'Magaginegroups.magaginetitle_id'=>$id
                                ]
                                )->order(["number"=>"ASC"]);
         $groupfilename = [];

         foreach($group as $val){
             $groupfilename[$val[ 'id' ]][ 'filename' ]="/comics/".$val[ 'users' ][ 'code' ]."/".$val[ 'magaginetitle_id' ]."/title/".$val[ 'id' ]."/s_".$val['filename'];
             $groupfilename[$val[ 'id' ]][ 'name'     ]=$val['name'];
             $groupfilename[$val[ 'id' ]][ 'note'       ]=$val['note'];
             $groupfilename[$val[ 'id' ]][ 'status'       ]=$val['status'];
             $groupfilename[$val[ 'id' ]][ 'id'       ]=$val['id'];
         }
         if(count($groupfilename) == 0){
            return $this->redirect(['action' => '../members/create2/'.$id]);
         }
         
        $this->set("groupfilename",$groupfilename);
    }
    public function groupedit($id = null){
        
        $userid = $this->Auth->user("id");
        
         $group = $this->MagazineGroup
                        ->find()
                        ->select([
                            'Magaginegroups.filename',
                            'Magaginegroups.name',
                            'Magaginegroups.note',
                            'Magaginegroups.magaginetitle_id',
                            'Magaginegroups.id',
                            'users.code'
                            ])
                        ->innerJoin(
                                ['magazinetitles'=>'magazinetitles'],
                                ['magazinetitles.id=Magaginegroups.magaginetitle_id']
                                )
                        ->innerJoin(
                                ['users'=>'users'],
                                ['magazinetitles.user_id=users.id']
                                )
                        ->where(
                                ['magazinetitles.user_id'=>$userid,
                                'Magaginegroups.id'=>$id
                                ]
                                )->toArray();
         if(!$group[0][ 'id' ]){
             return $this->redirect(['action' => '../members/']);
         }
         if ($this->request->is('post')) {
             
            $grp = $this->MagazineGroup->find()->where(['id'=>$id,'magaginetitle_id'=>$group[0][ 'magaginetitle_id' ]])->first();
            $grp->name = $this->request->data("name");
            $grp->filename = $this->request->data("filename");
            $grp->note=$this->request->data('note');
            $grp->modified = time();
            $this->MagazineGroup->save($grp);
            $code = $this->Auth->user('code');

            $frompath = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/title/".$this->request->data('filename');
            $topath = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/title/".$group[0][ 'id' ]."/".$this->request->data('filename');
            $this->moveImage($frompath,$topath);
            $frompath = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/title/s_".$this->request->data('filename');
            $topath = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/title/".$group[0][ 'id' ]."/s_".$this->request->data('filename');
            $this->moveImage($frompath,$topath);
            $path = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/title/";
            $this->deleteImageFile($path);
            

            $datafilename = $this->request->data("datafilename");
            $number = 1;
            
            foreach($datafilename as $key=>$val){
                $frompath = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/data/".$val;
                $topath = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/data/".$group[0][ 'id' ]."/".$val;
                
                $data = $this->MagazineData->get($key, [
                    'contain' => []
                ]);
                $data->filename = $val;
                $data->number = $number;
                $data->modified = time();
                $this->MagazineData->save($data);

                $this->moveImage($frompath,$topath);
                
                $frompath = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/data/s_".$val;
                $topath = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/data/".$group[0][ 'id' ]."/s_".$val;

                
                $this->moveImage($frompath,$topath);
                $number++;
            }
            $path = WWW_ROOT."comics/".$code."/".$group[0][ 'magaginetitle_id' ]."/data/";
            $this->deleteImageFile($path);
            
            
           $this->Flash->success(__('編集に成功しました'));
            return $this->redirect(['action' => '../members/']);
            
        }
        
         $groupdata = $this->MagazineData->find()
                 ->where([
                     'user_id'=>$userid,
                     'magazinetitle_id'=>$group[0][ 'magaginetitle_id' ],
                     'magazinegroup_id'=>$id
                 ])
                 ->order(['number'=>'ASC'])
                 ->toArray();

        $this->set("group",$group[0]);
        $this->set("groupid",$id);
        $this->set("code",$group[0][ 'users' ][ 'code' ]);
        $this->set("groupdata",$groupdata);
    }
    
    
    
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $where = [
            'id'=>$this->request->data("id"),
            'user_id'=>$this->Auth->user("id"),
            'magazinegroup_id'=>$id
        ];
        $this->MagazineData->deleteAll($where,false);
        exit();
        
    }
    
    public function deletetopdata($id = null)
    {
        $userid = $this->Auth->user("id");
                
        $delete = $this->Magazinetitles->query()->delete();
        $delete->where(['id'=>$id]);
        $delete->execute();
        
        
        $delete = $this->MagazineGroup->query()->delete();
        $delete->where(['magaginetitle_id'=>$id]);
        $delete->execute();
        
        
        $delete = $this->MagazineData->query()->delete();
        $delete->where(['magazinetitle_id'=>$id]);
        $delete->execute();
        
        $dir = WWW_ROOT."comics/".$this->Auth->user("code")."/".$id."/";
        $this->unlinkRecursive($dir,false);
        
        $this->Flash->success(__('データ削除しました'));
        return $this->redirect(['action' => '../members/']);
    }
    
    public function groupdataimagedelete($id=""){
        $userid = $this->Auth->user("id");
        $code = $this->Auth->user("code");
        
        $grp = $this->MagazineData->find()->where(['id'=>$id])->first();

        if($grp){
            $deletefile = WWW_ROOT."comics/".$code."/".$grp['magazinetitle_id']."/data/".$grp[ 'magazinegroup_id' ]."/".$grp[ 'filename' ];
            if(file_exists($deletefile)){
                unlink($deletefile);
            }
            $deletefile2 = WWW_ROOT."comics/".$code."/".$grp['magazinetitle_id']."/data/".$grp[ 'magazinegroup_id' ]."/s_".$grp[ 'filename' ];
            if(file_exists($deletefile2)){
                unlink($deletefile2);
            }

            $delete = $this->MagazineData->get($id);
            $this->MagazineData->delete($delete);

            $this->Flash->success(__(' データの削除に成功しました'));
            return $this->redirect(['action' => '../members/groupedit/'.$grp[ 'magazinegroup_id' ]]);
        }else{
            $this->Flash->error(__(' データの削除に失敗しました'));
            return $this->redirect(['action' => '../members/']);
        }
        
    }
    public function addgroupdatafileupload($titleid,$groupid){
        
        $file = $this->request->data['image'];
        $user = $this->Auth->user();
        $userid = $this->Auth->user("id");
        $code = $user[ 'code' ];
        $dir = "/comics/".$code."/".$titleid."/data/".$groupid."/";
        $pathdir = WWW_ROOT.$dir;
        
        $this->makeDirectory($code,$titleid,"data",$groupid);
        $filename = $this->File->fileuploads($file,$pathdir); 

        
        $mag = $this->MagazineData->newEntity();
       // $mag = $this->MagazineGroup->patchEntity($mag, $this->request->getData());

        $number = $this->getDataMaxNumber($groupid);

        $mag->filename = $filename;
        $mag->created = time();
        $mag->modified = time();
        $mag->user_id = $userid;
        $mag->magazinetitle_id = $titleid;
        $mag->magazinegroup_id = $groupid;
        $mag->number=$number;
        $save = $this->MagazineData->save($mag);
        
        exit();
        
    }
    public function profile(){
        $userid = $this->Auth->user("id");
        if ($this->request->is('post')) {
            $user = $this->Users->get($userid, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                //$user = $this->Users->patchEntity($user, $this->request->getData());
                $user->username = $this->request->data("username");
                if($this->request->data('password')){
                    $user->password = $this->request->data('password');
                }
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('登録内容の変更を行いました'));

                    return $this->redirect(['action' => '/profile/']);
                }
                $this->Flash->error(__('編集に失敗しました。'));
            }
        }
        
        
        
        $user_data = $this->Users->find()
                ->where(['id'=>$userid])
                ->first()
                ->toArray();

        $this->set("user",$user_data);
    }
}
