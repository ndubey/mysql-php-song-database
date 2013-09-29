<?php
include 'library/dbconnect.php';
if($_GET["cmd"]=="delete")
{
  	$id=$_GET['id'];
	if (empty($id)) { 

    	Header("Location: listSong.php"); 

    	exit; 

  	}


  	$query = "DELETE FROM Songs WHERE SongId=$id";

	 $result = mysql_query($query);


	  Header("Location: listSong.php"); 

	  exit; 


}
?>

