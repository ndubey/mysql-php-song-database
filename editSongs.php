<?php

  // connect to the database

  include('library/dbconnect.php');

    

    $error = false;

    

  // run this only, once the user has hit the "Add Song" button

  if (isset($_POST['editSong'])) {

    // assign form inputs

    $Title = $_POST['Title'];

    $ArtistId = $_POST['ArtistId'];
    $AlbumId  = $_POST['AlbumId'];
    $GenreId  = $_POST['GenreId'];   
    $Year     = $_POST['Year'];
    $Rating   = $_POST['Rating'];
    $visit = 1;
    if(!empty($Rating)){
	$query = "select * from Rating join Songs where Rating.Song_Title=Songs.Title";
	$result = mysql_query($query);
	$count = mysql_num_rows($result);
	if($count==0){
		$query="insert into Rating values('".$Title."','".$Rating."','".$visits."')";		
		$result=mysql_query($query);
	}else{
		$list=mysql_fetch_array($result);
		$visit = $list['Visits'];
		$average = (($visit*$list['Stars'])+$Rating)/($visit+1);
		$visit = $visit + 1;
		$Rating=$average;	
	}
    }
   
    $query = "select Title from Songs where Title='".$Title."'";
    $result=mysql_query($query);
    
    if(mysql_num_rows($result) > 0){
	$query = "update Songs set GenreId ='".$GenreId."' , ArtistId='".$ArtistId."', AlbumId ='".$AlbumId."', YearofRelease='".$Year."', Rating='".$Rating."' where Title='".$Title."'";
	$result=mysql_query($query);
	$query = "update Rating set Visits =$visit , Stars=$Rating where Song_Title='".$Title."'";
	$result = mysql_query($query); 
	echo "Succesfully updated";
    }else{
    if ( !empty($Title) && !empty($ArtistId) && !empty($AlbumId)  && !empty($GenreId) && !empty($Year) && !empty($Rating)) {    

    

      $query = "INSERT INTO Songs (Title,GenreId,ArtistId,AlbumId,YearofRelease,Rating) VALUES ('".$Title."','".$GenreId."','".$ArtistId."','".$AlbumId."','".$Year."','".$Rating."')";

      $result = mysql_query($query);

         $message = "\'".$Title."'\ has been successfully added.";

      echo 'Successfully added';  

  
      exit; 

    }

    else {

      $error = true; // input validation failed

    }

  }
}
?>

<html>

<head>

  <title>Update Songs</title>

</head>

<body>

Song List | <a href="listSong.php">Song</a>

<h1 align="center">Update a Song</h1>

<form align="center" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php

  if ( !empty($message) ) {

    echo '<span style="color:green">',$message,'</span><br><br>',"\n";

    }

?>
<?php

  if ( $error && empty($Title)){

    echo '<span style="color:red">Error! Please enter Title of the Song.</span><br>',"\n";

  }

?>

  <p>Song Title:

    <input name="Title" type="text" value="<?php echo $Title; ?>">

    <br><br>
<?php
    if( $error && empty($ArtistId) ) {
	echo '<span style="color:red">Error! Please select an Artist.</span><br>',"\n";

 }
?>

 Artist:
        <select name="ArtistId">
    	<option value="0" <?php if (empty($ArtistId)) echo "selected"; ?>>- select -</option>
<?php
	$query="SELECT ArtistId,ArtistName FROM Artist ORDER BY ArtistName";
	$result = mysql_query ($query);


	while($row=mysql_fetch_array($result)){
	echo "<option value=$row[ArtistId]>$row[ArtistName]</option>";
	/* Option values are added by looping through the array */
	}
?>

</select>  
<br><br>
 Album:
        <select name="AlbumId">
    	<option value="0" <?php if (empty($AlbumId)) echo "selected"; ?>>- select -</option>
<?php
	$query="SELECT AlbumId,AlbumName FROM Album ORDER BY AlbumName";

/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

	$result = mysql_query ($query);

	while($row=mysql_fetch_array($result)){//Array or records stored in $row
	echo "<option value=$row[AlbumId]>$row[AlbumName]</option>";
	/* Option values are added by looping through the array */
}
?>
</select>  

  <br><br>
 Genre:
        <select name="GenreId">
	<option value="0" <?php if (empty($GenreId)) echo "selected"; ?>>- select -</option>
<?php
	$query="SELECT GenreId,GName FROM AllGenres ORDER BY GName";

/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

	$result = mysql_query ($query);

	while($row=mysql_fetch_array($result)){//Array or records stored in $row
	echo "<option value=$row[GenreId]>$row[GName]</option>";
/* Option values are added by looping through the array */
}
?>
</select>  
  <br>
<?php

  if ( $error && empty($Year) ) {

    echo '<span style="color:red">Error! Please enter Year of Release.</span><br>',"\n";

  }

?>

  	<p>Year:

   	<input name="Year" type="text" value="<?php echo $Year; ?>">
<br>
<?php

 	if ( $error && empty($Rating) ) {

    	echo '<span style="color:red">Error! Please enter Rating.</span><br>',"\n";

  }
?>

  	<p>Rating:

    <input name="Rating" type="text" value="<?php echo $Rating; ?>">
<br><br>
    <input type="submit" name="editSong" value="Update Song">

</form>
<br><br><br>
	<table align="center"><tr>
<td><a href="addArtist.php">Add more Artists</a></td><td>&nbsp;</td><td><a href="addAlbum.php">Add more Albums</a></td>
</tr>
</table>
</body>

</html>
