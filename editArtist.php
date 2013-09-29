<?php

  // connect to the database

include 'library/config.php';
include 'library/opendb.php';
   

    $error = false;

    

  // run this only, once the user has hit the "Add Contact" button

  if (isset($_POST['editArtist'])) {

    // assign form inputs

    $Artist = $_POST['Artist'];


         

    // validate inputs

    if ( !empty($Artist)  ) {    

	    // add member to database

      $query = "INSERT INTO ArtistName from Artist ";
      $ans = mysql_query($query);
      while($list = mysql_fetch_array($ans)){
		if($list['ArtistName'] == $Artist){
			echo "Cannot insert a duplicate entry"; 
			$error=true;exit;}
	}
     	      
      $query = "INSERT INTO Artist(ArtistName) VALUES ('".$Artist."')";

      $result = mysql_query($query);

          $message = "\"".$Artist. "\" has been successfully added.";

        
	echo "$Artist added into the list";
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

  <title>Add Artist</title>

</head>

<body>

Add Artist | <a href="listArtist.php">Artist</a>

<h1>Add Artist</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php

  if ( !empty($Artist) ) {

    echo '<span style="color:green">',$message,'</span><br><br>',"\n";

    }

?>
  Artist Name:

  <input name="Artist" type="text" value="<?php echo $Artist; ?>">

  <br>

  <br>


    <input type="submit" name="addArtist" value="Add Artist">

</form>

</body>

</html>
