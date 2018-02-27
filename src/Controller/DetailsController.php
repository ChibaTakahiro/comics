<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 *
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DetailsController extends AppController
{

    public function initialize() {
        parent::initialize();

       $authid = $this->request->getSession()->read('Auth.Member.id');
       
       
       
        $this->set("authid",$authid);
        $this->viewBuilder()->setLayout('detail');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=0)
    {
        
        
    }
    public function open($titleid=0,$groupid=0)
    {
        $data = $this->Details->find()
                ->contain(['magaginegroups','users'])
                ->where([
                    'Details.magazinetitle_id'=>$titleid,
                    'Details.magazinegroup_id'=>$groupid,
                    'magaginegroups.status'=>1
                    ])
                ->order(["magaginegroups.number"=>"ASC"])
                ->toArray();
        
        $list = [];
        $num = 0;
        $k = 1;
        $ceil = ceil(count($data)/2);
        for($i=0;$i<$ceil;$i++){
            if(isset($data[$k-1])){
                $list[$i][1] = $data[$k-1];
                $list[$i][1]['code'] = $data[$k-1]['user'][ 'code' ];
                $k++;
            }
            if(isset($data[$k-1])){
                $list[$i][0] = $data[$k-1];
                $list[$i][0]['code'] = $data[$k-1]['user'][ 'code' ];
                $k++;
            }
            
        }
        
        $list = array_reverse($list);
        
        $this->set("list",$list);
        $this->set("ceil",$ceil);
    }
    
    
    public function vopen($titleid=0,$groupid=0)
    {
        $data = $this->Details->find()
                ->contain(['magaginegroups','users'])
                ->where([
                    'Details.magazinetitle_id'=>$titleid,
                    'Details.magazinegroup_id'=>$groupid,
                    'magaginegroups.status'=>1
                    ])
                ->order(["magaginegroups.number"=>"ASC"])
                ->toArray();
        
        $list = [];
        $num = 0;
        $k = 1;
        /*
        $ceil = ceil(count($data)/2);
        for($i=0;$i<$ceil;$i++){
            if(isset($data[$k-1])){
                $list[$i][1] = $data[$k-1];
                $list[$i][1]['code'] = $data[$k-1]['user'][ 'code' ];
                $k++;
            }
            if(isset($data[$k-1])){
                $list[$i][0] = $data[$k-1];
                $list[$i][0]['code'] = $data[$k-1]['user'][ 'code' ];
                $k++;
            }
            
        }
        
        $list = array_reverse($list);
        */
        $this->set("list",$data);
      //  $this->set("ceil",$ceil);
    }
    
    
}
