<?php
include("../privfiles/in.php");
?>
<div id="title">Player Ranking</div>
<br />
<table cellpadding="3" cellspacing="3" border="1">
	<tr style="font-weight: bold">
		<td width="50px">Rank</td>
		<td width="150px">Name</td>
		<td width="50px">Lv</td>
		<td width="50px">Wins</td>
		<td width="50px">Battles</td>
		<td width="50px">Win %</td>
	</tr>
	<?php
	$get_users = mysqli_query($conn, "SELECT username,r.*,level FROM user u JOIN userranks r ON u.id=r.id JOIN userstats s ON u.id=s.id WHERE wins>='0' ORDER BY wins DESC LIMIT 50") or die(mysqli_error($conn));
	$r = 1;
	while($row = mysqli_fetch_assoc($get_users)){
		echo "<tr>";
		echo "<td>" . $r . "</td>";
		echo '<td><a href="op.php?id=' .$row['id']. '">' . $row['username'] . '</a></td>';
		echo "<td>" . $row['level'] . "</td>";
		echo "<td>" . $row['wins'] . "</td>";
		echo "<td>" . $row['battles'] . "</td>";
		echo "<td>" . $row['winpc'] . "</td>";
		echo "</tr>";
		$r++;
	}
	?>
</table>
<?php
include("../privfiles/footer.php");
?>