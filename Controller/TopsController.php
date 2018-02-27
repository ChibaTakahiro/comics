<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 *
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TopsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function initialize() {
        parent::initialize();
        
       $authid = $this->request->getSession()->read('Auth.Member.id');
       
       $this->Magazinetitles = TableRegistry::get('Magazinetitles');
       $this->Users = TableRegistry::get('Users');
       $this->MagazineGroups = TableRegistry::get('Magaginegroups');
       $this->Category = TableRegistry::get('categories');
       
       
        $this->set("authid",$authid);
        $this->viewBuilder()->setLayout('open');
    }
    public function index()
    {
        
        
        $data = $this->Tops->find()
                ->contain(['magazinetitles','users'])
                ->where([
                    'magazinetitles.status'=>1,
                    'Tops.status'=>1
                    ])
                ->order([ 'Tops.modified'=>'DESC' ])
                ->toArray();
        
        $category = $this->Category->find()->toArray();
        $categories = [];
        foreach($category as $val){
            $categories[$val[ 'id' ]] = $val[ 'name' ];
        }

        $this->set("data",$data);
        $this->set("appObj",$this);
        $this->set("categories",$categories);
        
    }
    
    public function beforeFilter(Event $event){
            parent::beforeFilter($event);

    }
    public function isAuthorized($user = null){
            
            return true;
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        /*
        $book = $this->Books->get($id, [
            'contain' => []
        ]);
         * 
         */

    //    $this->set('book', $book);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $book = $this->Books->newEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $this->set(compact('book'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $this->set(compact('book'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
