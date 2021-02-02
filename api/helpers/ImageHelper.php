<?php

namespace api\helpers;

use api\helpers\ResponseHelper;
use yii\base\NotSupportedException;

 class ImageHelper{



     public static function  ImageFromUrl($url , $upPath='profile'){


         $path = \Yii::getAlias('@storage'). '/web/source/'.$upPath;
         if (!file_exists($path)) {
             mkdir($path, 077, true);
         }

         $userImage= 'img-'.md5(uniqid(rand(), 1)) . "." . 'jpeg';
         $thumb_image = file_get_contents($url);
         if ($http_response_header != NULL) {
             $thumb_file = $path . $userImage;
             file_put_contents($thumb_file, $thumb_image);
         }
        // $cmd_convert='convert '.$thumb_file.' -fuzz 10% -transparent  '.$thumb_file;
        //   exec($cmd_convert);


         return  $userImage ;
         }



     public static function  ImageFromBinary($binary , $upPath='profile'){


         $path = \Yii::getAlias('@storage'). '/web/source/'.$upPath;
         if (!file_exists($path)) {
             mkdir($path, 0777, true);
         }


         $imageInfo = explode(";base64,", $binary);
         $imgExt = str_replace('data:image/', '', $imageInfo[0]);
         $image = str_replace(' ', '+', $imageInfo[1]);
         $imageName = "img-".time().".".$imgExt;

         $imagePath= $path.'/'.$imageName;

         file_put_contents($imagePath,$image);

         return  $imageName;
     }

     public static function  Base64Image($base64_image_string , $upPath='profile'){

        $path = \Yii::getAlias('@storage'). '/web/source/'.$upPath;
         if (!file_exists($path)) {
             mkdir($path, 0777, true);
         }

        //data is like:    data:image/png;base64,asdfasdfasdf
        $splited = explode(',', substr( $base64_image_string , 5 ) , 2);
        $mime = $splited[0];
        $data = $splited[1];
        $mime_split_without_base64=explode(';', $mime,2);
        $mime_split=explode('/', $mime_split_without_base64[0],2);
        if(count($mime_split)==2)
        {
            $extension=$mime_split[1];
            if($extension=='jpeg')$extension='jpg';
            $output_file_with_extension= 'IMG_'.time().'.'.$extension;
        }
         $path = \Yii::getAlias('@storage'). '/web/source/'.$upPath.'/';

        file_put_contents( $path . $output_file_with_extension, base64_decode($data) );
        return $output_file_with_extension;
     }




        public static  function delete_files($target) {
            if(is_dir($target)){
                $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

                foreach( $files as $file )
                {
                    ImageHelper::delete_files( $file );
                }

                rmdir( $target );
                } elseif(is_file($target)) {
                    unlink( $target );
                }
     }



     public static function Base64IMageConverter($binary , $upPath='profile'){

         $path = \Yii::getAlias('@storage'). '/web/source/'.$upPath;
         if (!file_exists($path)) {
             mkdir($path, 0777, true);
         }
         $imageName = "img-". (intval(time()) + rand(1,100000) ).".jpeg";

         $directory= $path.'/'.$imageName;

         $data = explode(',', $binary);
         if (count($data) > 1) {
            $binary = base64_decode($data[1]);
         }else{
            $binary = base64_decode($binary);
         }
         $image = imagecreatefromstring($binary);

         header ( 'Content-type:image/jpeg' );

         imagejpeg($image, $directory);

         imagedestroy ( $image );

         if(file_exists($directory)){
             return $imageName;
         }else{
            return new NotSupportedException("File Not Allowed");
            return false;
         }
     }


     public static function Base64IPdfConverter($pdf_content , $upPath='profile'){

         $path = \Yii::getAlias('@storage'). '/web/source/'.$upPath;
         if (!file_exists($path)) {
             mkdir($path, 0777, true);
         }
         $FileName = "file-". (intval(time()) + rand(1,100000) ).".pdf";

         $directory= $path.'/'.$FileName;


         $data = explode(',', $pdf_content);
//Decode pdf content
         $pdf_decoded = base64_decode ($data[1]);
//Write data back to pdf file
         $pdf = fopen ($directory,'w');

         fwrite ($pdf,$pdf_decoded);
//close output file
         fclose ($pdf);

         if(file_exists($directory)){
             return $FileName;
         }else{
             return false;
         }
     }


 }
?>
