<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistsController extends AppController
{

  public function initialize() {
      parent::initialize();

     $authid = $this->request->getSession()->read('Auth.Member.id');




      $this->set("authid",$authid);
      $this->viewBuilder()->setLayout('open');
  }
  public function index(){
  	//echo "test";
  }

}
