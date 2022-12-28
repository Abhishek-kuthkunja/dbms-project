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
	$sql="select PhoneNumber from project.login where PhoneNumber=".$phonenumber;
	$result = $conn->query($sql);

	if($result->num_rows ==0) 
	{
		$smt = $conn->prepare("insert into project.login(UserName, PhoneNumber) values(?, ?)");
		$smt->bind_param("ss", $name, $phonenumber);
		$execval = $smt->execute();
		$smt->close();
	}
try{
	$s=array_pop($songs);
	$stmt = $conn->prepare("insert into project.playlist(PhoneNumber, PlaylistName, Songs) values(?, ?, ?)");
	$stmt->bind_param("sss",$phonenumber,$nameid,$s);
	$execval = $stmt->execute();
	$stmt->close();
	$n-=1;
	for ($j=0; $j<$n; $j++) {
		
		$s=array_pop($songs);
		$stmt = $conn->prepare("insert into project.playlist(PhoneNumber, PlaylistName, Songs) values(?, ?, ?)");
		$stmt->bind_param("sss",$phonenumber,$nameid,$s);
		$execval = $stmt->execute();
		$stmt->close();
		
	}
	echo "Playlist Created successfully...";	
}
catch(Exception $e){
	echo "playlist already present try new name";
}
	$conn->close();
}
if(isset($_POST['Showplaylist'])){
	
	$phonenumber = $_POST['phonenumber'];
	$nameid=$_POST['nameid'];


	$conn = new mysqli('localhost','root','','music');

	$sql="select PlaylistName,Songs from  project.playlist where PhoneNumber=".$phonenumber;
	$result = $conn->query($sql);
//show playlist of user using phonenumber
if ($result->num_rows > 0) {
  echo "<table border=1><tr><th>PlaylistName</th><th>Songs</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["PlaylistName"]."</td><td>".$row["Songs"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "No Playlist Created or no user";
}
$conn->close();
}
if(isset($_POST['Deleteplaylist']))
{
	$phonenumber = $_POST['phonenumber'];
	$nameid=$_POST['nameid'];
	$conn = new mysqli('localhost','root','','music');

	$sql="select PhoneNumber from project.login where PhoneNumber=".$phonenumber;
	$result = $conn->query($sql);

	if ($result->num_rows >0) {
		//delete the user and playlist
	$sql="delete from project.playlist where PhoneNumber=".$phonenumber;
	$sql1="delete from project.login where PhoneNumber=".$phonenumber;
	$result = $conn->query($sql);
	$result1 = $conn->query($sql1);
	echo "the user and playlist is deleted";
	}
	else
	{
		echo "user doesnt exist";
	}
$conn->close();	
}
if(isset($_POST['Updateplaylist'])){
	
	$name = $_POST['name'];
	$phonenumber = $_POST['phonenumber'];
	$conn = new mysqli('localhost','root','','music');
	//update the username using phonenumber

	$sql="select PhoneNumber from project.login where PhoneNumber=".$phonenumber;
	$result = $conn->query($sql);

	if($result->num_rows ==0) 
	{
		echo "there is no playlist";
		$conn->close();

	}
	else{
	$stmt = $conn->prepare("update project.login set UserName=? where PhoneNumber=?");
	$stmt->bind_param("ss",$name,$phonenumber);
	$execval = $stmt->execute();
	$stmt->close();
	echo "username got updated";
	$conn->close();
	}

}


?>