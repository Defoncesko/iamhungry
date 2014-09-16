<?php

if ( !empty( $_FILES ) ) {

    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
	$uuid = uniqid();
	$name = $uuid.".".pathinfo( $_FILES['file']['name'], PATHINFO_EXTENSION);
    $uploadPathFull =  '..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'media'. DIRECTORY_SEPARATOR .'antisanti'. DIRECTORY_SEPARATOR .'images' . DIRECTORY_SEPARATOR .$name;

    $uploadPath =  '..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'media'. DIRECTORY_SEPARATOR .'antisanti'. DIRECTORY_SEPARATOR .'images' . DIRECTORY_SEPARATOR;

    $pathForThumbnail = '..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'media'. DIRECTORY_SEPARATOR .'antisanti'. DIRECTORY_SEPARATOR .'images' . DIRECTORY_SEPARATOR .'thumbnail'. DIRECTORY_SEPARATOR;
   //$pathForCopy = '..'. DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'media'. DIRECTORY_SEPARATOR .'antisanti'. DIRECTORY_SEPARATOR .'images' . DIRECTORY_SEPARATOR .'copy'. DIRECTORY_SEPARATOR;
    
    move_uploaded_file( $tempPath, $uploadPathFull );

    makeThumbnails($name,$uploadPath,$pathForThumbnail);
    

    $answer = array( 'answer' => 'File transfer completed' , 'name' => $name);
    $json = json_encode( $answer );

    echo $json;


} else {

    echo 'No files';

}



function makeThumbnails($img,$pathFrom,$pathTo)
{
    $thumbnail_width = 140;
    $thumbnail_height = 100;
    $thumb_beforeword = "";
    $arr_image_details = getimagesize($pathFrom.$img); // pass id to thumb name
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }
    $dest_x = intval(($thumbnail_width - $new_width)/2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);
    if ($arr_image_details[2] == 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }
    if ($imgt) {
        $old_image = $imgcreatefrom($pathFrom.$img);
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        copy($pathFrom.$thumb_beforeword.$img,$pathFrom."real/".$img);

        $imgt($new_image,$pathFrom.$thumb_beforeword.$img);

        copy($pathFrom."real/".$img,$pathTo.$thumb_beforeword.$img);
        //move_uploaded_file( "$thumb_beforeword" . "$img", "img" );

    }
}


?>