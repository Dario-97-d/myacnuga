<?php include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){exit(header("Location: index"));}
?>
<div id="title">Mail sent</div><br />
<?php
if(isset($_POST['pmdel'])){
	$pmidel = prot($conn, $_POST['pmdel']);
	$delpm = mysqli_query($conn, "DELETE FROM mailbox WHERE pmid='".$pmidel."'") or die(mysqli_error($conn));
	output("PM deleted");
}
$getpms = mysqli_query($conn, "SELECT m.*,u.id FROM mailbox m LEFT JOIN user u ON m.pmfrom=u.username WHERE pmfrom='".$udata['username']."' ORDER BY time DESC") or die(mysqli_error($conn));
if(mysqli_num_rows($getpms) < 1){output("No messages.");}
else{
	while($pms = mysqli_fetch_assoc($getpms)){
		echo '<b>Sent to:</b> <a href="op.php?id=' . $pms['id'] . '">' . $pms['pmto'] . "</a><br /><b>";
		echo date("d/m H:i:s", $pms['time']) . "</b>";
		echo '<div id="msg">' . nl2br($pms['pmtext']) . "</div>";
		if($pms['seen'] == 0){
			echo '<span style="color: #204080; padding: 5px;"><b>Not Seen</b></span>';
		}
		?>
		<table>
			<td>
			<form action="mr.php" method="POST">
			<input type="submit"class="button1" value="Delete"/>
			<input type="hidden" name="pmdel" value="<?php echo $pms['pmid']; ?>"/>
			</form>
			</td>
			<td>
			<form action="mp.php" method="POST">
			<input type="submit" class="button1" value="New PM"/>
			<input type="hidden" name="pmto" value="<?php echo $pms['pmto']; ?>"/>
			</form>
			</td>
		</table>
		<?php
	}
}
include("../privfiles/footer.php");?>