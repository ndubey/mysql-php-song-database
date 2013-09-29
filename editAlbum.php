<?php

  // connect to the database

  include('library/dbconnect.php');

    

    $error = false;

    

  // run this only, once the user has hit the "Add Contact" button

  if (isset($_POST['addAlbum'])) {

    // assign form inputs

    $Album = $_POST['Album'];

   // $Dname = $_POST['Dname'];

         

    // validate inputs

    if ( !empty($Album)  ) {    

      // add member to database

      $query = "SELECT AlbumName from Album ";
      $ans = mysql_query($query);
      while($list = mysql_fetch_array($ans)){
		if($list['AlbumName'] == $Album){
			echo "Cannot insert a duplicate entry"; 
			$error=true;exit;}
	}
 
      $query = "INSERT INTO Album(AlbumName) VALUES ('".$Album."')";

      $result = mysql_query($query);

          $message = "\"".$Album. "\" has been successfully added.";

        
	echo "$Album added into the list";
  //    Header("Location: listArtists.php"); 

      exit; 

    }

    else {

      $error = true; // input validation failed

    }

  }

?>

<html>

<head>

  <title>Add Album</title>

</head>

<body>

Add Album | <a href="listAlbum.php">Artist</a>

<h1>Add Album</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php

  if ( !empty($Album) ) {

    echo '<span style="color:green">',$Album,'</span><br><br>',"\n";

    }

?>
  Album Name:

  <input name="Album" type="text" value="<?php echo $Album; ?>">

  <br>

  <br>


    <input type="submit" name="addAlbum" value="Add Album">

</form>

</body>

</html>
