<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        //$this->loadComponent("Auth");
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');

    }
    public function getThumnail($imagepath){
        $ex = explode("/",$imagepath);
        $pop = array_pop($ex);
        $thum = "s_".$pop;
        $imp = implode("/",$ex);
        $returnpath = $imp."/".$thum;

        return $returnpath;

    }
    public function makeDirectory($code,$titleid = 0,$makedir="",$grpid = 0){
        $dir = WWW_ROOT."comics/".$code;
        
        if($titleid > 0){
            $dir = $dir."/".$titleid."/";
            if(!file_exists($dir)){ mkdir($dir); }
        }
        if($titleid > 0 && $makedir){
            $dir = $dir."/".$makedir."/";
        }
        if($grpid > 0){
            $dir = $dir.$grpid;
        }
        if(!file_exists($dir)){
            mkdir($dir);
        }
    }
    
    public function moveImage($fromPath,$toPath){
        if(file_exists($fromPath)){
            rename($fromPath,$toPath);
        }
    }
    
    public function deleteImageFile($path){
        $glob = glob($path."{*.jpg,*.gif.*.png}", GLOB_BRACE);
        foreach($glob as $filename){
            if(file_exists($filename)){
                unlink($filename);
            }
        }
    }
    public function createBackupDir($path){
        if(!file_exists($path)){
            mkdir($path);
        }
    }
    
    
    
    public function unlinkRecursive($dir, $deleteRootToo)
    {
        if(!$dh = @opendir($dir))
        {
            return;
        }
        while (false !== ($obj = readdir($dh)))
        {   
           if($obj == '.' || $obj == '..')
           {
                continue;
             }  

            if (!@unlink($dir . '/' . $obj))
            {
               $this->unlinkRecursive($dir.'/'.$obj, true);
            }
        }

        closedir($dh);

        if ($deleteRootToo)
        {
        @rmdir($dir);
        }

        return;
    }
    
    
}
