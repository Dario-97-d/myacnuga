<?php
include("../privfiles/functions.php");

// Turns every half-hour

$get_users = mysqli_query($conn, "SELECT * FROM userstats") or die(mysqli_error($conn));
while($ustats = mysqli_fetch_assoc($get_users)){
	if(($ustats['energy'] + $ustats['nrgreg']) < $ustats['maxnrg']){
		$ustats['energy'] += $ustats['nrgreg'];
		$udnrg1 = mysqli_query($conn, "UPDATE userstats SET energy='".$ustats['energy']."' WHERE id='".$ustats['id']."'") or die(mysqli_error($conn));
	}else{
		$udnrg2 = mysqli_query($conn, "UPDATE userstats SET energy='".$ustats['maxnrg']."' WHERE id='".$ustats['id']."'") or die(mysqli_error($conn));
	}
}
$delb = mysqli_query($conn, "DELETE FROM battles WHERE time<".(time()-432000)."") or die(mysqli_error($conn));
$delm = mysqli_query($conn, "DELETE FROM mailbox WHERE time<".(time()-432000)."") or die(mysqli_error($conn));
$delgf = mysqli_query($conn, "DELETE FROM guildfeed WHERE time<".(time()-432000)."") or die(mysqli_error($conn));
?>