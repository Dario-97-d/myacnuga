<?php //still to be updated
include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){
	header("Location: index.php");
	exit;
}else{
	if(!isset($_POST['battle'])){
		header("Location: overview.php");
	}else{
		?>
		<div id="title">Battle</div>
		<?php
		$pid = prot($conn, $_POST['id']);
		$user_check = mysqli_query($conn, "SELECT username,r.*,a.* FROM user u JOIN userranks r ON u.id=r.id JOIN useratts a ON u.id=a.id WHERE u.id='".$pid."'") or die(mysqli_error($conn));
		if(mysqli_num_rows($user_check) != 1){
			header("Location: overview.php");
		}elseif($pid == $_SESSION['uid']){
			output("You can't attack yourself!");
			echo '<a href="op.php?id=' .$pid. '">Back</a>';
		}elseif($udata['energy'] < 15){
			output("Not enough stamina!");
			echo '<a href="op.php?id=' .$pid. '">Back</a>';
		}else{
			$pdata = mysqli_fetch_assoc($user_check);
			$uhit = (($udata['speed'] + (2* $udata['skill']) )/( $pdata['speed'] + (2* $pdata['sense'])));
			if($uhit >= 1){
				$uchance = 1-(1/(2* $uhit));
			}else{
				$uchance = $uhit/2;
			}
			$udam = ($udata['strength'] + ($udata['skill'] *2)) - (($pdata['strength'] /2) + $pdata['sense']);
			if($udam < 0){
				$udamage = 0;
			}else{
				$udamage = floor($udam);
			}
			$phit = (($pdata['speed'] + (2* $pdata['skill']) )/( $udata['speed'] + (2* $udata['sense'])));
			if($phit >= 1){
				$pchance = 1-(1/(2* $phit));
			}else{
				$pchance = $phit/2;
			}
			$pdam = ($pdata['strength'] + ($pdata['skill'] *2)) - (($udata['strength'] /2) + $udata['sense']);
			if($pdam < 0){
				$pdamage = 0;
			}else{
				$pdamage = floor($pdam);
			}
			?>
			<br />
			<table align="center" style="text-align: center; color: #A6A6A6;">
				<tr>
					<td width="150px"><?php echo $udata['username']; ?></td>
					<td width="150px"></td>
					<td width="150px"><?php echo $pdata['username']; ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (11/30) && $uchance < (13/30)) || ($uchance >= (15/30) && $uchance < (17/30)) || ($uchance >= (19/30))){
						$uri = $udamage;
						echo $udamage;
					}else{
						$uri = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 1</td>
					<td><b><?php
					if(($pchance >= (11/30) && $pchance < (13/30)) || ($pchance >= (15/30) && $pchance < (17/30)) || ($pchance >= (19/30))){
						$pri = $pdamage;
						echo $pdamage;
					}else{
						$pri = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (9/30) && $uchance < (11/30)) || ($uchance >= (13/30) && $uchance < (15/30)) || ($uchance >= (17/30) && $uchance < (19/30)) || ($uchance >= (21/30))){
						$urii = $udamage;
						echo $udamage;
					}else{
						$urii = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 2</td>
					<td><b><?php
					if(($pchance >= (9/30) && $pchance < (11/30)) || ($pchance >= (13/30) && $pchance < (15/30)) || ($pchance >= (17/30) && $pchance < (19/30)) || ($pchance >= (21/30))){
						$prii = $pdamage;
						echo $pdamage;
					}else{
						$prii = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (7/30) && $uchance < (9/30)) || ($uchance >= (15/30) && $uchance < (21/30)) || ($uchance >= (23/30))){
						$uriii = $udamage;
						echo $udamage;
					}else{
						$uriii = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 3</td>
					<td><b><?php
					if(($pchance >= (7/30) && $pchance < (9/30)) || ($pchance >= (15/30) && $pchance < (21/30)) || ($pchance >= (23/30))){
						$priii = $pdamage;
						echo $pdamage;
					}else{
						$priii = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (5/30) && $uchance < (7/30)) || ($uchance >= (13/30) && $uchance < (15/30)) || ($uchance >= (17/30) && $uchance < (23/30)) || ($uchance >= (25/30))){
						$uriv = $udamage;
						echo $udamage;
					}else{
						$uriv = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 4</td>
					<td><b><?php
					if(($pchance >= (5/30) && $pchance < (7/30)) || ($pchance >= (13/30) && $pchance < (15/30)) || ($pchance >= (17/30) && $pchance < (23/30)) || ($pchance >= (25/30))){
						$priv = $pdamage;
						echo $pdamage;
					}else{
						$priv = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (11/30) && $uchance < (13/30)) || ($uchance >= (15/30) && $uchance < (17/30)) || ($uchance >= (19/30))){
						$urv = $udamage;
						echo $udamage;
					}else{
						$urv = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 5</td>
					<td><b><?php
					if(($pchance >= (11/30) && $pchance < (13/30)) || ($pchance >= (15/30) && $pchance < (17/30)) || ($pchance >= (19/30))){
						$prv = $pdamage;
						echo $pdamage;
					}else{
						$prv = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (9/30) && $uchance < (11/30)) || ($uchance >= (13/30) && $uchance < (15/30)) || ($uchance >= (17/30) && $uchance < (19/30)) || ($uchance >= (21/30))){
						$urvi = $udamage;
						echo $udamage;
					}else{
						$urvi = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 6</td>
					<td><b><?php
					if(($pchance >= (9/30) && $pchance < (11/30)) || ($pchance >= (13/30) && $pchance < (15/30)) || ($pchance >= (17/30) && $pchance < (19/30)) || ($pchance >= (21/30))){
						$prvi = $pdamage;
						echo $pdamage;
					}else{
						$prvi = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (7/30) && $uchance < (9/30)) || ($uchance >= (11/30) && $uchance < (13/30)) || ($uchance >= (15/30) && $uchance < (17/30)) || ($uchance >= (19/30) && $uchance < (21/30)) || ($uchance >= (23/30))){
						$urvii = $udamage;
						echo $udamage;
					}else{
						$urvii = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 7</td>
					<td><b><?php
					if(($pchance >= (7/30) && $pchance < (9/30)) || ($pchance >= (11/30) && $pchance < (13/30)) || ($pchance >= (15/30) && $pchance < (17/30)) || ($pchance >= (19/30) && $pchance < (21/30)) || ($pchance >= (23/30))){
						$prvii = $pdamage;
						echo $pdamage;
					}else{
						$prvii = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (5/30) && $uchance < (7/30)) || ($uchance >= (9/30) && $uchance < (11/30)) || ($uchance >= (13/30) && $uchance < (15/30)) || ($uchance >= (17/30) && $uchance < (19/30)) || ($uchance >= (21/30) && $uchance < (23/30)) || ($uchance >= (25/30))){
						$urviii = $udamage;
						echo $udamage;
					}else{
						$urviii = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 8</td>
					<td><b><?php
					if(($pchance >= (5/30) && $pchance < (7/30)) || ($pchance >= (9/30) && $pchance < (11/30)) || ($pchance >= (13/30) && $pchance < (15/30)) || ($pchance >= (17/30) && $pchance < (19/30)) || ($pchance >= (21/30) && $pchance < (23/30)) || ($pchance >= (25/30))){
						$prviii = $pdamage;
						echo $pdamage;
					}else{
						$prviii = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (3/30) && $uchance < (5/30)) || ($uchance >= (7/30) && $uchance < (9/30)) || ($uchance >= (11/30) && $uchance < (13/30)) || ($uchance >= (15/30) && $uchance < (17/30)) || ($uchance >= (19/30) && $uchance < (21/30)) || ($uchance >= (23/30) && $uchance < (25/30)) || ($uchance >= (27/30))){
						$urix = $udamage;
						echo $udamage;
					}else{
						$urix = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 9</td>
					<td><b><?php
					if(($pchance >= (3/30) && $pchance < (5/30)) || ($pchance >= (7/30) && $pchance < (9/30)) || ($pchance >= (11/30) && $pchance < (13/30)) || ($pchance >= (15/30) && $pchance < (17/30)) || ($pchance >= (19/30) && $pchance < (21/30)) || ($pchance >= (23/30) && $pchance < (25/30)) || ($pchance >= (27/30))){
						$prix = $pdamage;
						echo $pdamage;
					}else{
						$prix = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (1/30) && $uchance < (3/30)) || ($uchance >= (13/30) && $uchance < (15/30)) || ($uchance >= (17/30) && $uchance < (27/30)) || ($uchance >= (29/30))){
						$urx = $udamage;
						echo $udamage;
					}else{
						$urx = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 10</td>
					<td><b><?php
					if(($pchance >= (1/30) && $pchance < (3/30)) || ($pchance >= (13/30) && $pchance < (15/30)) || ($pchance >= (17/30) && $pchance < (27/30)) || ($pchance >= (29/30))){
						$prx = $pdamage;
						echo $pdamage;
					}else{
						$prx = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (11/30) && $uchance < (13/30)) || ($uchance >= (15/30) && $uchance < (17/30)) || ($uchance >= (19/30))){
						$urxi = $udamage;
						echo $udamage;
					}else{
						$urxi = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 11</td>
					<td><b><?php
					if(($pchance >= (11/30) && $pchance < (13/30)) || ($pchance >= (15/30) && $pchance < (17/30)) || ($pchance >= (19/30))){
						$prxi = $pdamage;
						echo $pdamage;
					}else{
						$prxi = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (9/30) && $uchance < (11/30)) || ($uchance >= (13/30) && $uchance < (15/30)) || ($uchance >= (17/30) && $uchance < (19/30)) || ($uchance >= (21/30))){
						$urxii = $udamage;
						echo $udamage;
					}else{
						$urxii = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 12</td>
					<td><b><?php
					if(($pchance >= (9/30) && $pchance < (11/30)) || ($pchance >= (13/30) && $pchance < (15/30)) || ($pchance >= (17/30) && $pchance < (19/30)) || ($pchance >= (21/30))){
						$prxii = $pdamage;
						echo $pdamage;
					}else{
						$prxii = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (7/30) && $uchance < (9/30)) || ($uchance >= (15/30) && $uchance < (21/30)) || ($uchance >= (23/30))){
						$urxiii = $udamage;
						echo $udamage;
					}else{
						$urxiii = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 13</td>
					<td><b><?php
					if(($pchance >= (7/30) && $pchance < (9/30)) || ($pchance >= (15/30) && $pchance < (21/30)) || ($pchance >= (23/30))){
						$prxiii = $pdamage;
						echo $pdamage;
					}else{
						$prxiii = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (5/30) && $uchance < (7/30)) || ($uchance >= (9/30) && $uchance < (11/30)) || ($uchance >= (13/30) && $uchance < (15/30)) || ($uchance >= (17/30) && $uchance < (19/30)) || ($uchance >= (21/30) && $uchance < (23/30)) || ($uchance >= (25/30))){
						$urxiv = $udamage;
						echo $udamage;
					}else{
						$urxiv = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 14</td>
					<td><b><?php
					if(($pchance >= (5/30) && $pchance < (7/30)) || ($pchance >= (9/30) && $pchance < (11/30)) || ($pchance >= (13/30) && $pchance < (15/30)) || ($pchance >= (17/30) && $pchance < (19/30)) || ($pchance >= (21/30) && $pchance < (23/30)) || ($pchance >= (25/30))){
						$prxiv = $pdamage;
						echo $pdamage;
					}else{
						$prxiv = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td><b><?php
					if(($uchance >= (3/30) && $uchance < (5/30)) || ($uchance >= (11/30) && $uchance < (13/30)) || ($uchance >= (15/30) && $uchance < (17/30)) || ($uchance >= (19/30) && $uchance < (25/30)) || ($uchance >= (27/30))){
						$urxv = $udamage;
						echo $udamage;
					}else{
						$urxv = 0;
						echo "-";
					}
					?></b></td>
					<td>Round 15</td>
					<td><b><?php
					if(($pchance >= (3/30) && $pchance < (5/30)) || ($pchance >= (11/30) && $pchance < (13/30)) || ($pchance >= (15/30) && $pchance < (17/30)) || ($pchance >= (19/30) && $uchance < (25/30)) || ($pchance >= (27/30))){
						$prxv = $pdamage;
						echo $pdamage;
					}else{
						$prxv = 0;
						echo "-";
					}
					?></b></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b><?php $udmg = $uri + $urii + $uriii + $uriv + $urv + $urvi + $urvii + $urviii + $urix + $urx + $urxi + $urxii + $urxiii + $urxiv + $urxv;
					echo $udmg;?></b></td>
					<td>Total</td>
					<td><b><?php $pdmg = $pri + $prii + $priii + $priv + $prv + $prvi + $prvii + $prviii + $prix + $prx + $prxi + $prxii + $prxiii + $prxiv + $prxv;
					echo $pdmg; ?></b></td>
				</tr>
			</table>
			<?php
			$udata['exp'] += 15;
			$udata['energy'] -= 15;
			$nrgbattle = mysqli_query($conn, "UPDATE userstats SET exp='".$udata['exp']."', energy='".$udata['energy']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			include("../privfiles/newlvl.php");
			$update_battles = mysqli_query($conn, "INSERT INTO battles (attacker,defender,attdamage,defdamage,time) VALUES ('".$udata['username']."','".$pdata['username']."','".$udmg."','".$pdmg."','".time()."') ") or die(mysqli_error($conn));
			if($udmg > $pdmg){
				$udata['wins'] += 1;
				$udata['battles'] += 1;
				$udata['winpc'] = ($udata['wins']*100)/$udata['battles'];
				$win_ranks1u = mysqli_query($conn, "UPDATE userranks SET wins='".$udata['wins']."', battles='".$udata['battles']."', winpc='".$udata['winpc']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
				$pdata['battles'] += 1;
				$pdata['winpc'] = ($pdata['wins']*100)/$pdata['battles'];
				$win_ranks2p = mysqli_query($conn, "UPDATE userranks SET battles='".$pdata['battles']."', winpc='".$pdata['winpc']."' WHERE id='".$pid."'") or die(mysqli_error($conn));
				output("Win!");
			}elseif($udmg == $pdmg){
				$udata['battles'] += 1;
				$udata['winpc'] = ($udata['wins']*100)/$udata['battles'];
				$tie_ranks1u = mysqli_query($conn, "UPDATE userranks SET battles='".$udata['battles']."', winpc='".$udata['winpc']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
				$pdata['battles'] += 1;
				$pdata['winpc'] = ($pdata['wins']*100)/$pdata['battles'];
				$tie_ranks2p = mysqli_query($conn, "UPDATE userranks SET battles='".$pdata['battles']."', winpc='".$pdata['winpc']."' WHERE id='".$pid."'") or die(mysqli_error($conn));
				output("That's a tie.");				
			}else{
				$udata['battles'] += 1;
				$udata['winpc'] = ($udata['wins']*100)/$udata['battles'];
				$lost_ranks1u = mysqli_query($conn, "UPDATE userranks SET battles='".$udata['battles']."', winpc='".$udata['winpc']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
				$pdata['wins'] += 1;
				$pdata['battles'] += 1;
				$pdata['winpc'] = ($pdata['wins']*100)/$pdata['battles'];
				$lost_ranks2p = mysqli_query($conn, "UPDATE userranks SET wins='".$pdata['wins']."',  battles='".$pdata['battles']."', winpc='".$pdata['winpc']."' WHERE id='".$pid."'") or die(mysqli_error($conn));
				output("You lost!");
			}
		}
	}
}
include("../privfiles/footer.php");
?>