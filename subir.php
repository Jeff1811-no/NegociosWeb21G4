<?php 

    $content = $_FILES['img']['tmp_name'];
    $id=$_POST["id"].'.png';
    if(file_exists("public/img/".$id)){
        unlink("public/img/".$id);
        clearstatcache($clear_realpath_cache=TRUE);
    }

    $fp = "public/img/".$id;
   
    move_uploaded_file($content,$fp);
    echo $fp;
    // echo '<img src="'.$fp.'?l=11" style="width:250px;height:250px;"/>';
      
?>

