<?php
include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){
	header ("Location: index.php");
}else{
	?>
	<div id="title">My Battles</div>
	<br />
	<table cellpadding="3" border="1">
		<tr style="text-align: center; font-weight: bold">
			<td>Time</td>
			<td width="150px">Attacker</td>
			<td width="50px">Att</td>
			<td width="50px">Def</td>
			<td width="150px">Defender</td>
			<td width="150px">Winner</td>
		</tr>
		<?php
		$get_hist = mysqli_query($conn, "SELECT * FROM battles WHERE attacker='".$udata['username']."' OR defender='".$udata['username']."' ORDER BY time DESC") or die(mysqli_error($conn));
		while($hist = mysqli_fetch_assoc($get_hist)){
			echo '<tr style="text-align: center;">';
			echo "<td>" . date("d/m H:i:s", $hist['time']) . "</td>";
			echo "<td>" . $hist['attacker'] . "</td>";
			echo "<td>" . $hist['attdamage'] . "</td>";
			echo "<td>" . $hist['defdamage'] . "</td>";
			echo "<td>" . $hist['defender'] . "</td>";
			echo "<td>";
			if($hist['attdamage'] > $hist['defdamage']){
				echo $hist['attacker'];
			}elseif($hist['attdamage'] < $hist['defdamage']){
				echo $hist['defender'];
			}else{
				echo "---";
			}
			echo "</td>";
			echo "</tr>";
		}
		?>
	</table>
	<?php
}
include("../privfiles/footer.php");
?>