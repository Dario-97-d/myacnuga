<?
// might put this in cron
$getguilds = mysqli_query($conn, "SELECT guildid FROM guilds") or die(mysqli_error($conn));
while($updgs = mysqli_fetch_assoc($getguilds)){
	$countgms = mysqli_query($conn, "SELECT id FROM userguild WHERE gid=".$updgs['guildid']."") or die(mysqli_error($conn));
	$cgms = mysqli_num_rows($countgms);
	$sagwins = mysqli_query($conn, "SELECT AVG(winpc) AS awp, SUM(wins) AS sw FROM userguild g JOIN userranks r ON g.id=r.id WHERE g.gid='".$updgs['guildid']."'") or die(mysqli_error($conn));
	$sagw = mysqli_fetch_assoc($sagwins);
	$wpp = $sumgw['sw'] / $cgms;
	$updateguildrank = mysqli_query($conn, "UPDATE guildrank SET members=".$cgms.", pwins=".$sagw['sw'].", winpp=".$wpp.", awinpc=".$sagw['awp']."") or die(mysqli_error($conn));
}
?>