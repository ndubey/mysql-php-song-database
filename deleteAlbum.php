<?php
include 'library/dbconnect.php';
if($_GET["cmd"]=="delete")
{
  	$id=$_GET['id'];
	if (empty($id)) { 

    	Header("Location: listAlbum.php"); 

    	exit; 

  	}


  	$query = "DELETE FROM Album WHERE AlbumId=$id";

	 $result = mysql_query($query);


	  Header("Location: listAlbum.php"); 

	  exit; 


}
?>

