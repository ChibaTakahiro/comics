<?php

namespace App\Controller\Component;
use Cake\Controller\Component;
class FileComponent extends Component {
     public function getHello() {
          return "hello world!";
     }
     
     public function fileuploads ($file = null,$dir = null, $limitFileSize = 1024 * 1024){
        try {
            // ファイルを保存するフォルダ $dirの値のチェック
            if ($dir){
                if(!file_exists($dir)){
                    echo "no dir";
                    exit();
                }
            } else {
                echo "no dir2";
                exit();
            }

            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            if (!isset($file['error']) || is_array($file['error'])){
                throw new RuntimeException('Invalid parameters.');
            }

            // エラーのチェック
            switch ($file['error']) {
                case 0:
                    break;
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // ファイル情報取得
            
         //   $fileInfo = new File($file["tmp_name"]);
            $size = $file[ 'size' ];
            // ファイルサイズのチェック
            if ($size > $limitFileSize) {
                throw new RuntimeException('Exceeded filesize limit.');
            }
          
            $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            //$fname = pathinfo($file[ 'name' ],PATHINFO_FILENAME);
            $fname = uniqid();
            // ファイル名の生成
            $uploadFile = $fname . "." . $ext;
//            $uploadFile = sha1_file($file["tmp_name"]) . "." . $ext;

            // ファイルの移動
            //ファイルのリサイズ
            $this->resizeImage($file,300,"s_".$fname,$dir);
            
            
            if (!@move_uploaded_file($file["tmp_name"], $dir . "/" . $uploadFile)){
                throw new RuntimeException('Failed to move uploaded file.');
            }
            

            // 処理を抜けたら正常終了
//            echo 'File is uploaded successfully.';

        } catch (RuntimeException $e) {
            throw $e;
        }
        return $uploadFile;
    }
    
    public function resizeImage($image, $new_width, $filename, $dir = "."){
        
            list($width,$height,$type) = getimagesize($image["tmp_name"]);
            $new_height = round($height*$new_width/$width);
            $emp_img = imagecreatetruecolor($new_width,$new_height);
            switch($type){
                    case IMAGETYPE_JPEG:
                            $new_image = imagecreatefromjpeg($image["tmp_name"]);
                            break;
                    case IMAGETYPE_GIF:
                            $new_image = imagecreatefromgif($image["tmp_name"]);
                            break;
                    case IMAGETYPE_PNG:
                            imagealphablending($emp_img, false);
                            imagesavealpha($emp_img, true);
                            $new_image = imagecreatefrompng($image["tmp_name"]);
                            break;
            }
            imagecopyresampled($emp_img,$new_image,0,0,0,0,$new_width,$new_height,$width,$height);
            $date = $filename;
            switch($type){
                    case IMAGETYPE_JPEG:
                            imagejpeg($emp_img,$dir."/".$date.".jpg");
                            break;
                    case IMAGETYPE_GIF:
                            $bgcolor = imagecolorallocatealpha($new_image,0,0,0,127);
                            imagefill($emp_img, 0, 0, $bgcolor);
                            imagecolortransparent($emp_img,$bgcolor);
                            imagegif($emp_img,$dir."/".$date.".gif");
                            break;
                    case IMAGETYPE_PNG:
                            imagepng($emp_img,$dir."/".$date.".png");
                            break;
            }
            imagedestroy($emp_img);
            imagedestroy($new_image);
    }
}

?>