<?php
include 'library/dbconnect.php';
if($_GET["cmd"]=="delete")
{
  	$id=$_GET['id'];
	if (empty($id)) { 

    	Header("Location: listArtist.php"); 

    	exit; 

  	}


  	$query = "DELETE FROM Artist WHERE ArtistId=$id";

	 $result = mysql_query($query);


	  Header("Location: listArtist.php"); 

	  exit; 


}
?>

