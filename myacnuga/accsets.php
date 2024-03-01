<?php
include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){
	header("Location: index.php");
}else{
	$pdesc = $udata['pdesc'];
	if(isset($_POST['chemail'])){
		$nempw = prot($conn, $_POST['nempw']);
		if(md5($nempw) != $udata['password']){
			output("Wrong password");
		}else{
			$nemce = prot($conn, $_POST['chemail']);
			if(strlen($nemce) > 48 || strlen($nemce) < 8){
				output("E-mail must be min. 8, max. 48 characters long.");
			}else{
				$updem = mysqli_query($conn, "UPDATE user SET email='".$nemce."' WHERE id=".$_SESSION['uid']."") or die(mysqli_error($conn));
				output("Your email has been updated");
			}
		}
	}elseif(isset($_POST['newpw'])){
		$olpw = prot($conn, $_POST['oldpw']);
		if(md5($olpw) != $udata['password']){
			output("Wrong password");
		}else{
			$nupw = prot($conn, $_POST['newpw']);
			if(strlen($nupw) > 32 || strlen($nupw) < 8){
				output("Password must be min. 8, max. 32 characters long.");
			}else{
				$updpw = mysqli_query($conn, "UPDATE user SET password='".md5($nupw)."' WHERE id=".$_SESSION['uid']."") or die(mysqli_error($conn));
				output("Your password has been updated");
			}
		}
	}elseif(isset($_POST['npd'])){
		$dsc = $_POST['ndsc'];
		if(strlen($dsc) > 4000){
			output("Description is too long. Max: 4000 characters");
		}else{
			$updesc = mysqli_query($conn, "UPDATE user SET pdesc='".$dsc."' WHERE id=".$_SESSION['uid']."") or die(mysqli_error($conn));
			output("Description has been updated");
			$pdesc = $dsc;
		}
	}
	?>
	<div id="title"><a href="accsets.php">Account Settings</a></div>
	<form action="accsets.php" method="POST">
		<br />New e-mail:<br /><input type="email" style="width: 256px" name="chemail" value="<?php echo $udata['email'];?>" maxlength="48"/><br />
		<br />Password:<br /><input type="password" name="nempw"/><br />
		<br /><input type="submit" class="button1" value="Change E-mail"/><br />
	</form>
	<form action="accsets.php" method="POST">
		<br />Old password:<br /><input type="password" name="oldpw"/><br />
		<br />New password:<br /><input type="password" name="newpw"/><br />
		<br /><input type="submit" class="button1" value="Change Password"/><br />
	</form>
	<br />
	<div id="title">Player Description</div>
	<form action="accsets.php" method="POST">
		<textarea name="ndsc" maxlength="4000"><?php echo $pdesc;?></textarea><br />
		<br /><input type="submit" class="button1" name="npd" value="Update"/>
	</form>
	<?php
}
include("../privfiles/footer.php");
?>