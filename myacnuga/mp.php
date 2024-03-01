<?php include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){exit(header("Location: index.php"));}
$upmto='';
$pmtext='';
if(isset($_POST['sendpm'])){
	$upmto = prot($conn, $_POST['pmto']);
	$getupmto = mysqli_query($conn, "SELECT username FROM user WHERE username='".$upmto."'") or die(mysqli_error($conn));
	if(mysqli_num_rows($getupmto) != 1){output("User not found!");}
	else{
		$pmtext = prot($conn, $_POST['pmtext']);
		if($pmtext == ""){output("Null message!");}
		elseif(strlen($pmtext) > 800){output("Message is too long! Max: 800 chrs.");}
		else{
			$pmsend = mysqli_query($conn, "INSERT INTO mailbox (time,pmfrom,pmto,pmtext,seen) VALUES ('".time()."','".$udata['username']."','".$upmto."','".$pmtext."',0)") or die(mysqli_error($conn));
			output("PM sent!");
		}
	}
}elseif(isset($_POST['pmto'])){
	$upmto = prot($conn, $_POST['pmto']);
	$getupmto = mysqli_query($conn, "SELECT username FROM user WHERE username='".$upmto."'") or die(mysqli_error($conn));
	if(mysqli_num_rows($getupmto) != 1){output("User not found!");}
}?>
<br />
<div id="title">Private Message</div>
<form action="mp" method="POST">
To: <input type="text" name="pmto" value="<?php echo $upmto;?>"/>
<br /><br />
<textarea name="pmtext" maxlength="800"><?php echo $pmtext;?></textarea>
<br /><br />
<input type="submit" class="button1" name="sendpm" value="Send"/>
</form>
<?php include("../privfiles/footer.php");?>