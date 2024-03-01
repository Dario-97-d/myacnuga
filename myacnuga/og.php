<?php
include("../privfiles/in.php");
if(!isset($_GET['id'])){exit(header("Location: index"));
}else{
	$gid = prot($conn, $_GET['id']);
	$guild_check = mysqli_query($conn, "SELECT * FROM guilds g JOIN guildrank r ON g.guildid=r.guildid WHERE g.guildid='".$gid."'") or die(mysqli_error($conn));
	if(mysqli_num_rows($guild_check) != 1){exit(header("Location: rg"));
	}else{
		$guild = mysqli_fetch_assoc($guild_check);
		echo '<div id="title">' . $guild['name'] . "["  . $guild['tag']. "]</div>";
		if(isset($_SESSION['uid']) && $udata['gid'] == 0){
			?>
			<form action="og.php" method="POST">
				<input type="submit"class="button1" value="Apply"/>
				<input type="hidden" name="gapplyid" value="<?php echo $gid; ?>"/>
			</form>
			<br /><br />
			<?php
		}
		?>
		<table align="right">
			<tr>
				<td>Members</td>
				<td><?php echo $guild['members'] . "/15"; ?></td>
			</tr>
			<tr>
				<td>Total Wins</td>
				<td><?php echo $guild['pwins']; ?></td>
			</tr>
			<tr>
				<td>Wins per player</td>
				<td><?php echo $guild['winpp']; ?></td>
			</tr>
			<tr>
				<td>Average Win %</td>
				<td><?php echo $guild['awinpc']; ?></td>
			</tr>
		</table>
		<table>
			<tr style="font-weight: bold;">
				<td width="50px">Rank</td>
				<td width="150px">Name</td>
				<td width="50px">Lv</td>
				<td width="50px">Wins</td>
				<td width="50px">Win %</td>
			</tr>
			<?php
			$getgmuser = mysqli_query($conn, "SELECT u.id,username,grank,level,wins,winpc FROM user u JOIN userguild g ON u.id=g.id JOIN userstats s ON u.id=s.id JOIN userranks r ON u.id=r.id WHERE g.gid='".$gid."' ORDER BY grank DESC") or die(mysqli_error($conn));
			while($grow = mysqli_fetch_assoc($getgmuser)){
				echo "<tr>";
				echo "<td>" . $grow['grank'] . "</td>";
				echo '<td><a href="op.php?id=' .$grow['id']. '">' .$grow['username']. "</a></td>";
				echo "<td>" . $grow['level'] . "</td>";
				echo "<td>" . $grow['wins'] . "</td>";
				echo "<td>" . $grow['winpc'] . "</td>";
				echo "</tr>";
			}
			?>
		</table>
		<br />
		<div id="title">Guild Description</div>
		<div id="textbody"><?php echo nl2br($guild['gdesc']); ?></div>
<?php
	}
}
include("../privfiles/footer.php");
?>