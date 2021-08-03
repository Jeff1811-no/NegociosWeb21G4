<?php

$response = 'invalid';
if(isset($_FILES['image']['name'])){

	$filename = $_FILES['image']['name'];
	$idprod = $_POST["id"];

	
	$location = "productos/".$filename;
	$extension = pathinfo($location,PATHINFO_EXTENSION);
	$extension = strtolower($extension);


	$newfilename = $idprod . '.' . $extension;
	$location = "productos/".$newfilename;

	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
	
	if(in_array($extension, $valid_extensions)) {
		if (file_exists("productos/".$idprod.".jpeg")) {
			unlink("./productos/".$idprod.".jpeg");
		}
		elseif(file_exists("productos/".$idprod.".jpg")){
			unlink("./productos/".$idprod.".jpg");
		}elseif (file_exists("productos/".$idprod.".png")) {
			unlink("./productos/".$idprod.".png");
		}
		elseif (file_exists("productos/".$idprod.".gif")) {
			unlink("./productos/".$idprod.".gif");
		}
	   	
	   	if(move_uploaded_file($_FILES['image']['tmp_name'],$location)){
	     	$response = $location;
	   	}
	}
}

echo $response;

?>