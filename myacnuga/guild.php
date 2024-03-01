<?php
include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){
	header("Location: index.php");
}else{
	if($udata['gid'] > 0){
		if(isset($_POST['leaveguild'])){
			if($udata['grank'] == 'Admin'){
				output("You're Admin, you can't just leave the guild");
			}else{
				$lg = prot($conn, $_POST['leaveguild']);
				if($lg == 'Leave Guild!'){
					$leaveguild = mysqli_query($conn, "UPDATE userguild SET guildid=0, grank='none', gseen=1 WHERE id=".$_SESSION['uid']."") or die(mysqli_error($conn));
					header("Location: guild.php");
				}
			}
		}
		include("../privfiles/updgr.php");
		$get_guild = mysqli_query($conn, "SELECT * FROM guilds WHERE guildid='".$udata['gid']."'") or die(mysqli_error($conn));
		$guild = mysqli_fetch_assoc($get_guild);
		echo '<div id="title"><a href="og.php?id=' . $guild['guildid'] . '">' . $guild['name'] . "["  . $guild['tag']. "]</a></div><br />";
		if($udata['grank'] == 'Admin'){
			?>
			<a href="gsets.php">-<u>Guild Settings</u></a>
			<br /><br />
			<?php
		}else{
			?>
			<form action="guild.php" method="POST">
				<select name="leaveguild">
					<option hidden="true">Leave Guild?</option>
					<option>Leave Guild!</option>
				</select>			
				<input type="submit" value="Go"/>
			</form>
			<?php
		}
		echo '<div id="title">Notice</div><div id="textbody">' . nl2br($guild['gnot']) . '</div>';
		?>
		<!-- applications -->
		<br /><div id="title">Feed</div>
		<?php
		if(isset($_POST['gfeed'])){
			$gf = prot($conn, $_POST['gfeed']);
			if($gf == "" || strlen($gf) > 200){
				output("Text is either null or too long (Max: 800 characters)");
			}else{
				$sendgfeed = mysqli_query($conn, "INSERT INTO guildfeed (gid,pname,gfeed,time) VALUES ('".$guild['guildid']."','".$udata['username']."','".$gf."',".time().")") or die(mysqli_error($conn));
			}
		}
		?>
		<form action="guild.php" method="POST">
			<input type="text" id="feed" name="gfeed" maxlength="200"/>
		</form>
		(<u><a href="guild.php">Reload</a></u>)
		<div id="gfeed" width="75%">
		<table cellspacing="5">
			<?php
			$getguildfeed = mysqli_query($conn, "SELECT * FROM guildfeed WHERE gid=".$guild['guildid']." ORDER BY time DESC LIMIT 50") or die(mysqli_error($conn));
			while($gfrow = mysqli_fetch_assoc($getguildfeed)){
				$getgfpid = mysqli_query($conn, "SELECT id FROM user WHERE username='".$gfrow['pname']."'") or die(mysqli_error($conn));
				$gfpid = mysqli_fetch_assoc($getgfpid);
				echo '<tr><td width="150px"><center><a href="op.php?id=' . $gfpid['id'] . '">' . $gfrow['pname'] . '</a><br /><b>' . date("d/m H:i:s", $gfrow['time']) . '</b></center></td>';
				echo '<td style="word-break: break-all;">' . nl2br($gfrow['gfeed']) . '</td></tr>';
			}
			?>
		</table>
		</div>
		<?php
	}else{
		if($udata['level'] >= 5){
			?>
			<div id="title">Start Guild</div><br />
			<form action="gsets.php" method="POST">
				<br />Guild Name (4-16 chs): <br /><input type="text" name="ngname"/><br />
				<br />Guild Tag (3-6 chs): <br /><input type="text" name="ngtag"/><br />
				<br /><input type="submit" class="button1" name="newguild" value="Start Guild"/>
			</form>
			<?php
		}else{
			echo "You'll be able to create a guild at Lv 5<br />";
		}
		if($udata['gapp'] != 'none'){
			echo "You have applied for " . $udata['gapp'];
		}else{
			echo 'Also you can apply for a <u><a href="rg.php">Guild</a></u><br /><br />';
		}
	}
}
include("../privfiles/footer.php");
?>