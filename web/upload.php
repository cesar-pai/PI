<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 2/1/2016
 * Time: 4:51 PM
 */
$file = $_FILES['file'];

    if(isset($file) && $file["error"]== UPLOAD_ERR_OK)
    {
        //check if this is an ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            return false;
        }

        //Is file size is less than allowed size.
        if ($file["size"] > 5242880) {
            die("File too big");
        }
        if(move_uploaded_file($file['tmp_name'], 'uploads/tmp/'.$file['name'] ))
        {
            die("Successfully moving the uploaded file");
        } else {
            die("Error when moving the uploaded file");
        }
    } else {
        die("Error when uploading the file");
    }




