<?php
if(isset($_POST['CreatePlaylist'])){
	$name = $_POST['name'];
	$phonenumber = $_POST['phonenumber'];
	$nameid=$_POST['nameid'];
	$songs=array();

	if (empty($_POST['1'])) {
 
	} else{
		array_push($songs,'yeleyele');
	}
if (empty($_POST['2'])) {
 
	} else{
		array_push($songs,'KaanunnaKalyanam');
	}
	if (empty($_POST['3'])) {
 
	} else{
		array_push($songs,'Inthandham');
	}
	if (empty($_POST['4'])) {
 
	} else{
		array_push($songs,'Kesariya');
	}
	if (empty($_POST['5'])) {
 
	} else{
		array_push($songs,'AmiJeTomar');
	}
	$n=sizeof($songs);
	if (empty($_POST['6'])) {
 
	} else{
		array_push($songs,'AyPilla');
	}
	$n=sizeof($songs);
	if (empty($_POST['7'])) {
 
	} else{
		array_push($songs,'InkemInkemKaavaale');
	}
	$n=sizeof($songs);
	if (empty($_POST['8'])) {
 
	} else{
		array_push($songs,'SarangaDariya');
	}
	$n=sizeof($songs);
	if (empty($_POST['9'])) {
 
	} else{
		array_push($songs,'Manasaa');
	}
	$n=sizeof($songs);
	if (empty($_POST['10'])) {
 
	} else{
		array_push($songs,'NeeChitramChoosi');
	}
	$n=sizeof($songs);
	if (empty($_POST['11'])) {
 
	} else{
		array_push($songs,'NuvvunteNaaJathagaa');
	}
	$n=sizeof($songs);
	if (empty($_POST['12'])) {
 
	} else{
		array_push($songs,'PeddaPuli');
	}
	$n=sizeof($songs);
	if (empty($_POST['13'])) {
 
	} else{
		array_push($songs,'PoolaneKunukeyamantaa');
	}
	$n=sizeof($songs);
	if (empty($_POST['14'])) {
 
	} else{
		array_push($songs,'ShivTandavStotram');
	}
	$n=sizeof($songs);
	if (empty($_POST['15'])) {
 
	} else{
		array_push($songs,'Vachindamma');
	}
	$n=sizeof($songs);



	$conn = new mysqli('localhost','root','','music');

	$s=array_pop($songs);
	$stmt = $conn->prepare("insert into songs(UserName, PhoneNumber, PlaylistName, SongName) values(?, ?, ?, ?)");
	$stmt->bind_param("ssss", $name, $phonenumber,$nameid,$s);
	$execval = $stmt->execute();
	$stmt->close();
	$n-=1;
	for ($j=0; $j<$n; $j++) {
		
		$nameid="";
		$s=array_pop($songs);
		$stmt = $conn->prepare("insert into songs(UserName, PhoneNumber, PlaylistName, SongName) values(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $name, $phonenumber,$nameid,$s);
		$execval = $stmt->execute();
		$stmt->close();
	}
	echo "Playlist Created successfully...";
	
	$conn->close();
}
if(isset($_POST['Showplaylist'])){
	
	$phonenumber = $_POST['phonenumber'];
	

	$conn = new mysqli('localhost','root','','music');

	$sql="select PlaylistName,SongName from songs where PhoneNumber=".$phonenumber;
	$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border=1><tr><th>PlaylistName</th><th>SongName</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["PlaylistName"]."</td><td>".$row["SongName"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "No Playlist Created";
}
$conn->close();
}
if(isset($_POST['Deleteplaylist']))
{
	
	$phonenumber = $_POST['phonenumber'];
	

	$conn = new mysqli('localhost','root','','music');

	$sql="delete from songs where PhoneNumber=".$phonenumber;
	$result = $conn->query($sql);
$conn->close();
}
if(isset($_POST['Updateplaylist'])){
	
	$name = $_POST['name'];
	$phonenumber = $_POST['phonenumber'];
	

	$conn = new mysqli('localhost','root','','music');

	$stmt = $conn->prepare("update songs set PhoneNumber=? where UserName=?");
	$stmt->bind_param("ss",$phonenumber,$name);
	$execval = $stmt->execute();
	$stmt->close();
	$conn->close();


}


?>