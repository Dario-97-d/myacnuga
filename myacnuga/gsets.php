<?php include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){exit(header("Location: index"));}
elseif(!isset($_POST['newguild'])){
	if(!$udata['gid'] > 0 || $udata['grank'] != 'Admin'){exit(header("Location: rg"));}
	$getgms = mysqli_query($conn, "SELECT id FROM userguild WHERE gid=".$udata['gid']."") or die(mysqli_error($conn));
	$gms = mysqli_fetch_assoc($getgms);
	if(isset($_POST['gnt'])){
		$checknextchange = mysqli_query($conn, "SELECT nextchange FROM guilds WHERE guildid=".$udata['gid']."") or die(mysqli_error($conn));
		$checknct = mysqli_fetch_assoc($checknextchange);
		if($checknct['nextchange'] > time()){
			output("You must wait 1 week after changing guild name/tag. Next change:");
			echo "<b>" . date("d/m H:i:s", $checknct['nextchange']) . "</b><br /><br />";
		}else{
			$newgname = prot($conn, $_POST['nugn']);
			$newgtag = prot($conn, $_POST['nugt']);
			if(strlen($newgname) < 4 || strlen($newgname) > 16 || strlen($newgtag) < 3 || strlen($newgtag) > 6){
				output("Guild name must be 4-16 characters long<br />Guild tag must be 3-6 characters long");
			}else{
				$checkgnt = mysqli_query($conn, "SELECT nextchange FROM guilds WHERE name='".$newgname."' OR tag='".$newgtag."'") or die(mysqli_error($conn));
				if(mysqli_num_rows($checkgnt) > 0){output("Either name or tag is already in use by another guild");}
				else{
					$nct = time() + 604800;
					$updgnt = mysqli_query($conn, "UPDATE guilds SET name='".$newgname."', tag='".$newgtag."', nextchange='".$nct."' WHERE guildid='".$udata['gid']."'") or die(mysqli_error($conn));
					output("Guild name and tag have been updated!");
				}
			}
		}
	}elseif(isset($_POST['gdesc'])){
		$newgdesc = prot($conn, $_POST['gdesc']);
		if(strlen($newgdesc) < 1 || strlen($newgdesc) > 4000){output("Guild description must be 1-4000 characters long");}
		else{
			$updgdesc = mysqli_query($conn, "UPDATE guilds SET gdesc='".$newgdesc."'") or die(mysqli_error($conn));
			output("Guild description has been updated");
		}
	}elseif(isset($_POST['gnot'])){
		$newgnot = prot($conn, $_POST['gnot']);
		if(strlen($newgnot) < 1 || strlen($newgnot) > 4000){output("Guild notice must be 1-4000 characters long");}
		else{
			$updgnot = mysqli_query($conn, "UPDATE guilds SET gnot='".$newgnot."'") or die(mysqli_error($conn));
			output("Guild notice has been updated");
		}
	}elseif(isset($_POST['gru']) && isset($_POST['nugr'])){
		$grun = prot($conn, $_POST['gru']);
		$checkname = mysqli_query($conn, "SELECT id FROM user WHERE username='".$grun."'") or die(mysqli_error($conn));
		$unid = mysqli_fetch_assoc($checkname);
		if($unid['id'] != $udata['id']){output("You can't administer your position in the guild");}
		else{
			$checknameg = mysqli_query($conn, "SELECT id,grank FROM userguild WHERE gid='".$udata['gid']."' AND id='".$unid['id']."'") or die(mysqli_error($conn));
			$ungid = mysqli_fetch_assoc($checknameg);
			$grur = prot($conn, $_POST['nugr']);
			if(mysqli_num_rows($checkname) != 1 || mysqli_num_rows($checknameg) != 1 || $unid['id'] != $ungid['id']){output("Invalid username");}
			elseif($grur == 'Admin' || $grur == 'Member'){
				$gram = mysqli_query($conn, "UPDATE userguild SET grank='$grur' WHERE id='".$unid['id']."'") or die(mysqli_error($conn));
				output("1 Guild rank has been updated");
				echo $grun . " is now " . $nugr;
			}elseif($grur == 'Dismiss'){
				$gmexpel = mysqli_query($conn, "UPDATE userguild SET gid=0, grank='none' WHERE id=".$unid['id']."") or die(mysqli_error($conn));
				output("1 Guild member has been dismissed: ");
				echo $grun;
			}elseif($grur == "Select Action"){output("Invalid Action");}
		}
	}
	$getginfo = mysqli_query($conn, "SELECT * FROM guilds WHERE guildid=".$udata['gid']."") or die(mysqli_error($conn));
	$ginfo = mysqli_fetch_assoc($getginfo);
	?>
	<div id="title"><a href="gsets">Guild Settings</a></div>
		<form action="gsets" method="POST">
			<br />Guild Name: <input type="text" name="nugn" value="<?php echo $ginfo['name'];?>"/>
			Guild Tag: <input type="text" name="nugt" value="<?php echo $ginfo['tag'];?>"/><br />
			<br /><input type="submit" class="button1" name="gnt" value="Change Name/Tag"/><br />
		</form>
	<div id="title">Guild Notice</div>
		<form action="gsets" method="POST">
			<textarea name="gnot"><?php echo $ginfo['gnot'];?></textarea><br />
			<br /><input type="submit" class="button1" value="New Notice"/><br />
		</form>
	<div id="title">Admin Members</div>
	<form action="gsets" method="POST">
		<select name="gru">
			<option hidden="true">Select Member</option>
			<?php
			$getgmns = mysqli_query($conn, "SELECT username FROM user u JOIN userguild g ON u.id=g.id WHERE g.gid=".$udata['gid']."") or die(mysqli_error($conn));
			while($garow = mysqli_fetch_assoc($getgmns)){
				echo "<option>" . $garow['username'] . "</option>";
			}
			?>
		</select>
		<select name="nugr">
			<option hidden="true">Select Action</option>
			<option>Admin</option>
			<option>Member</option>
			<option>Dismiss</option>
		</select>
		<br /><br />
		<input type="submit" class="button1" value="Set"/>
	</form>
	<div id="title">Guild Description</div>
	<form action="gsets" method="POST">
		<textarea name="gdesc"><?php echo $ginfo['gdesc']?></textarea><br />
		<br /><input type="submit" class="button1" value="New Description"/>
	</form>
	<?php
}elseif($udata['gid'] == 0){
	$ngname = prot($conn, $_POST['ngname']);
	$ngtag = prot($conn, $_POST['ngtag']);
	if(strlen($ngname) < 4 || strlen($ngname) > 16 || strlen($ngtag) < 3 || strlen($ngtag) > 6){
		output("Guild name must be 4-16 characters long<br />Guild tag must be 3-6 characters long");
		echo '<br /><a href="guild.php">Back to Guild Creation</a>';
		include("../privfiles/footer.php");
		exit;
	}elseif(strlen($ngtag) > strlen($ngname)){
		output("Guild name must be at least as long as tag");
		echo '<br /><a href="guild.php">Back to Guild Creation</a>';
		include("../privfiles/footer.php");
		exit;
	}
	$checkguild = mysqli_query($conn, "SELECT guildid FROM guilds WHERE name='".$ngname."' OR tag='".$ngtag."'") or die(mysqli_error($conn));
	if(mysqli_num_rows($checkguild) > 0){
		output("Guild name or tag already in use. Please choose another");
		echo '<br /><a href="guild.php">Back to Guild Creation</a>';
		include("../privfiles/footer.php");
		exit;
	}
	$newguild1 = mysqli_query($conn, "INSERT INTO guilds (name,tag,gdesc,gnot) VALUES ('".$ngname."','".$ngtag."','Guild Description','Guild Notice')") or die(mysqli_error($conn));
	$newguild2 = mysqli_query($conn, "INSERT INTO guildrank (members,pwins,winpp,awinpc) VALUES (1,'".$udata['wins']."','".$udata['wins']."','".$udata['winpc']."')") or die(mysqli_error($conn));
	$getnugid = mysqli_query($conn, "SELECT guildid FROM guilds WHERE name='".$ngname."'") or die(mysqli_error($conn));
	$nugid = mysqli_fetch_assoc($getnugid);
	$guildfounder = mysqli_query($conn, "UPDATE userguild SET gid='".$nugid."', grank='Admin', gapp='none' WHERE id=".$_SESSION['uid']."") or die(mysqli_error($conn));
	output("Your Guild has been created!");
	echo '<br /><a href="guild.php">Guild Settings</a>';
}
include("../privfiles/footer.php");
?>