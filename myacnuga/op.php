<?php include("../privfiles/in.php");

if(!isset($_GET['id'])){
	header("Location: index.php");
	exit;
}

$pid = prot($conn, $_GET['id']);
$user_check = mysqli_query($conn, "SELECT username,pdesc,s.*,a.*,r.* FROM user u JOIN userstats s ON u.id=s.id JOIN useratts a ON u.id=a.id JOIN userranks r ON u.id=r.id WHERE u.id='".$pid."'") or die(mysqli_error($conn));
if(mysqli_num_rows($user_check) != 1){
	header("Location: rp.php");
}else{
	$pdata = mysqli_fetch_assoc($user_check);
	?>
	<div id="title"><?php echo $pdata['username'];?></div>
	<table>
		<tr>
			<td>Level:</td>
			<td><b><?php echo $pdata['level']?></b></td>
		</tr>
		<tr>
			<td>XP:</td>
			<td><b><?php echo $pdata['exp'];?></b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Flair: </td>
			<td><b><?php echo $pdata['flair']?></b></td>
		</tr>
		<tr>
			<td>Sense: </td>
			<td><b><?php echo $pdata['sense']?></b></td>
		</tr>
		<tr>
			<td>Dexterity: </td>
			<td><b><?php echo $pdata['dexterity']?></b></td>
		</tr>
		<tr>
			<td>Agility: </td>
			<td><b><?php echo $pdata['agility']?></b></td>
		</tr>
		<tr>
			<td>Strength: </td>
			<td><b><?php echo $pdata['strength']?></b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Attack power: </td>
			<td><b><?php $p_attpow = $pdata['strength'] + ($pdata['dexterity'] *2);
			echo floor($p_attpow);?></b></td>
		</tr>
		<tr>
			<td>Defense power: </td>
			<td><b><?php $p_defpow = ($pdata['strength'] /2) + $pdata['dexterity'];
			echo floor($p_defpow);?></b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Wins/Battles (%):</td>
			<td><b><?php echo $pdata['wins'] . "/" . $pdata['battles'] . " (" . $pdata['winpc'] . "%)";?></b></td>
		</tr>
	</table>
	<?php
	if(isset($_SESSION['uid'])){
		if($udata['energy'] < 16){
			echo '<br /><span style="color: #204080">You cannot attack! Not enough Stamina</span>';
		}
		?>
		<table cellspacing="5">
			<td>
				<?php if($udata['energy'] > 15){?>
					<form action="battle.php" method="POST">
						<input type="submit" class="button1" name="battle" value="Attack"/>
				<?php }else{?>
					<form action="op.php" method="POST">
						<input type="button" class="button1" name="battle" value="Attack" disabled/>
				<?php }?>
					<input type="hidden" name="id" value="<?php echo $pid;?>"/>
				</form>
			</td>
			<td>
				<form action="mp.php" method="POST">
					<input type="submit" class="button1" value="Message"/>
					<input type="hidden" name="pmto" value="<?php echo $pdata['username'];?>"/>
				</form>
			</td>
		</table>
		<?php
	}
	echo '<div id="title">Player Description</div><div id="textbody">' . nl2br($pdata['pdesc']) . '</div>';
}
include("../privfiles/footer.php");
?>