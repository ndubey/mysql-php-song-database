<html>

<head>

  <title>List Artists</title>

</head>

<script language="JavaScript">

<!--

function confirmdelete(id)

{

  var c = confirm("Do you really want to remove this Artist from List?");

  if (c) { 

    window.location="deleteArtist.php?ArtistId="+ArtistId; 

  }

}

//-->

</script>

<body bgcolor="#E5E5E5">

<a href="addAlbum.php">Add Albums</a>&nbsp;|&nbsp;<a href="addArtist.php">Add Artists</a>&nbsp;|&nbsp;<a href="addSongs.php">Add Songs</a>&nbsp;|&nbsp;<a href="list.php">Song Search</a>
<h1 align="center" >Song List</h1>

<table  width ="800"  align="center" border="0" cellspacing="0" cellpadding="6">

  <tr bgcolor="#CCCCCC">



<?php

  include 'library/dbconnect.php';
  $query =" SELECT Songs.SongId,Songs.Title,AllGenres.GName,Artist.ArtistName,Album.AlbumName,YearofRelease,Rating  FROM Songs join Artist join Album join AllGenres WHERE Songs.ArtistId=Artist.ArtistId and Songs.AlbumId = Album.AlbumId and Songs.GenreId = AllGenres.GenreId  ";
  $result=mysql_query($query);
  $i=1;
  while($list=mysql_fetch_array($result)){
  if($i%2){   $color = '#CCCCCC';} 
	else { $color = '#F5F5F5'; }
$SongId = $list['SongId'];
?>
			<tr  bgcolor="<?php echo$color; ?>"><td><?php echo $list['SongId']; ?></td>
			<td><?php echo $list['Title']; ?> </td>	         <td><?php echo $list['GName']; ?></td>
			<td><?php echo $list['ArtistName']; ?> </td>	         <td><?php echo $list['AlbumName'];?></td>
			<td><?php echo $list['YearofRelease']; ?> </td>	         <td><?php echo $list['Rating'];?></td> 
			<td>
<?php
echo "<a href='deleteSong.php?cmd=delete&id=$SongId'>Delete</a>";
?>


			</tr>
<?php
			$i++;
		}	

?>

</table>

</body>

</html>

<?php


?>
