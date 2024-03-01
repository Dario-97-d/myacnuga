<?php
include("../privfiles/in.php");
include("../privfiles/updgr.php");
?>
<div id="title">Guild Ranking</div>
<br />
<table cellpadding="3" cellspacing="3" border="1">
	<tr style="font-weight: bold">
		<td width="50px">Rank</td>
		<td width="150px">Guild</td>
		<td>Members</td>
		<td width="100px">Wins</td>
		<td width="100px">Battles</td>
		<td>Win %</td>
		<td width="100px">Wins pP</td>
	</tr>
	<?php
	$get_guilds = mysqli_query($conn, "SELECT name,tag,r.* FROM guilds g JOIN guildrank r ON g.guildid=r.guildid ORDER BY pwins LIMIT 50") or die(mysqli_error($conn));
	$r = 1;
	while($row = mysqli_fetch_assoc($get_guilds)){
		echo "<tr>";
		echo "<td>" . $r . "</td>";
		echo '<td><a href="og.php?id=' .$row['guildid'].'">' . $row['name'] . "[" . $row['tag'] . "]</a></td>";
		echo "<td>" . $row['members'] . "</td>";
		echo "<td>" . $row['pwins'] . "</td>";
		echo "<td>" . $row['battles'] . "</td>";
		echo "<td>" . $row['awinpc'] . "</td>";
		echo "<td>" . $row['winpp'] . "</td>";
		echo "</tr>";
		$r++;
	}
	?>
</table>
<?php
include("../privfiles/footer.php");
?>