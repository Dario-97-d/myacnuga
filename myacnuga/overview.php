<?php include("../privfiles/in.php");

if(!isset($_SESSION['uid'])){exit(header("Location: index.php"));}
else{
	if(isset($_POST['trainflair'])){
		$nrgneed1 = $udata['flair'];
		if($nrgneed1 < $udata['energy']){
			$udata['flair'] += 1;
			$train1 = mysqli_query($conn, "UPDATE useratts SET flair='".$udata['flair']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			$udata['exp'] += $nrgneed1;
			$udata['energy'] -= $nrgneed1;
			$nrg1 = mysqli_query($conn, "UPDATE userstats SET exp='".$udata['exp']."', energy='".$udata['energy']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			include("../privfiles/newlvl.php");
		}else{
			output("Not enough stamina!");
		}
	}elseif(isset($_POST['trainsense'])){
		$nrgneed2 = $udata['sense'];
		if($nrgneed2 < $udata['energy']){
			$udata['sense'] += 1;
			$train2 = mysqli_query($conn, "UPDATE useratts SET sense='".$udata['sense']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			$udata['exp'] += $nrgneed2;
			$udata['energy'] -= $nrgneed2;
			$nrg2 = mysqli_query($conn, "UPDATE userstats SET exp='".$udata['exp']."', energy='".$udata['energy']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			include("../privfiles/newlvl.php");
		}else{
			output("Not enough stamina!");
		}
	}elseif(isset($_POST['traindexterity'])){
		$nrgneed3 = $udata['dexterity'];
		if($nrgneed3 < $udata['energy']){
			$udata['dexterity'] += 1;
			$train3 = mysqli_query($conn, "UPDATE useratts SET dexterity='".$udata['dexterity']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			$udata['exp'] += $nrgneed3;
			$udata['energy'] -= $nrgneed3;
			$nrg3 = mysqli_query($conn, "UPDATE userstats SET exp='".$udata['exp']."', energy='".$udata['energy']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			include("../privfiles/newlvl.php");
		}else{
			output("Not enough stamina!");
		}
	}elseif(isset($_POST['trainagility'])){
		$nrgneed4 = $udata['agility'];
		if($nrgneed4 < $udata['energy']){
			$udata['agility'] += 1;
			$train4 = mysqli_query($conn, "UPDATE useratts SET agility='".$udata['agility']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			$udata['exp'] += $nrgneed4;
			$udata['energy'] -= $nrgneed4;
			$nrg4 = mysqli_query($conn, "UPDATE userstats SET exp='".$udata['exp']."', energy='".$udata['energy']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			include("../privfiles/newlvl.php");
		}else{
			output("Not enough stamina!");
		}
	}elseif(isset($_POST['trainstrength'])){
		$nrgneed5 = $udata['strength'];
		if($nrgneed5 < $udata['energy']){
			$udata['strength'] += 1;
			$train5 = mysqli_query($conn, "UPDATE useratts SET strength='".$udata['strength']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			$udata['exp'] += $nrgneed5;
			$udata['energy'] -= $nrgneed5;
			$nrg5 = mysqli_query($conn, "UPDATE userstats SET exp='".$udata['exp']."', energy='".$udata['energy']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			include("../privfiles/newlvl.php");
		}else{
			output("Not enough stamina!");
		}
	}
	?>
	<div id="title"><?php echo $udata['username'];?></div>
	<table>
		<tr>
			<td width="128px"></td>
			<td></td>
		</tr>
		<tr>
            <td>Level:</td>
            <td><b><?php echo $udata['level']; ?></b></td>
        </tr>
		<tr>
            <td>XP (next level):</td>
            <td><b><?php echo $udata['exp'] . " (";
				include("../privfiles/levelxp.php");
				echo ")";?></b></td>
        </tr>
        <tr>
            <td>Stamina (Regen):</td>
            <td><b><?php echo $udata['energy'] . " / " . $udata['maxnrg'] . " (" . $udata['nrgreg'] . "/turn)"; ?></b></td>
        </tr>
	</table>
	<table>
		<tr>
			<td width="128px"></td>
			<td></td>
		</tr>
        <tr>
            <td>Flair:</td>
			<td><b><?php echo $udata['flair'];?></b></td>
            <td>
			<form action="overview.php" method="post">
				<input type="submit" name="trainflair" value="Train"/>
			</form></td>
        </tr>
        <tr>
            <td>Sense:</td>
			<td><b><?php echo $udata['sense'];?></b></td>
            <td>
			<form action="overview.php" method="post">
				<input type="submit" name="trainsense" value="Train"/>
			</form></td>
        </tr>
		<tr>
            <td>Dexterity:</td>
			<td><b><?php echo $udata['dexterity'];?></b></td>
            <td>
			<form action="overview.php" method="post">
				<input type="submit" name="traindexterity" value="Train"/>
			</form></td>
        </tr>
        <tr>
            <td>Agility:</td>
			<td><b><?php echo $udata['agility'];?></b></td>
            <td>
			<form action="overview.php" method="post">
				<input type="submit" name="trainagility" value="Train"/>
			</form></td>
        </tr>
        <tr>
            <td>Strength:</td>
			<td><b><?php echo $udata['strength'];?></b></td>
            <td>
			<form action="overview.php" method="post">
				<input type="submit" name="trainstrength" value="Train"/>
			</form></td>
        </tr>
	</table>
	<table>
		<tr>
            <td width="128px"></td>
            <td></td>
        </tr>
        <tr>
            <td>Attack power</td>
            <td><b><?php $attpow = $udata['strength'] + ($udata['dexterity'] *2);
			echo floor($attpow); ?></b></td>
        </tr>
		<tr>
            <td>Defense power</td>
            <td><b><?php $defpow = ($udata['strength'] /2) + $udata['dexterity'];
			echo floor($defpow); ?></b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Wins/Battles (%):</td>
            <td><b><?php echo $udata['wins'] . "/" . $udata['battles'] . " (" . $udata['winpc'] . " %)"; ?></b></td>
        </tr>
    </table>
	<?php
}
include("../privfiles/footer.php");
?>