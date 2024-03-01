<?php include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){exit(header("Location: index"));}
?>
<div id="title">Inbox</div><br />
<?php
if(isset($_POST['pmdel'])){
	$pmidel = prot($conn, $_POST['pmdel']);
	$delpm = mysqli_query($conn, "DELETE FROM mailbox WHERE pmid='".$pmidel."'") or die(mysqli_error($conn));
	output("PM deleted");
}
$getpms = mysqli_query($conn, "SELECT m.*,u.id FROM mailbox m LEFT JOIN user u ON m.pmto=u.username WHERE pmto='".$udata['username']."' ORDER BY time DESC") or die(mysqli_error($conn));
if(mysqli_num_rows($getpms) < 1){output("Mailbox is empty.");}
else{
	while($pms = mysqli_fetch_assoc($getpms)){
		echo '<b>From:</b> <a href="op?id=' . $pms['id'] . '">' . $pms['pmfrom'] . "</a><br /><b>";
		echo date("d/m H:i:s", $pms['time']) . "</b>";
		echo '<div id="msg">' . nl2br($pms['pmtext']) . "</div>";
		if($pms['seen'] == 0){echo '<span style="color: #204080; padding: 5px;"><b>New</b></span>';}
		?>
		<table>
			<td>
				<form action="mp" method="POST">
					<input type="submit" class="button1" value="Reply"/>
					<input type="hidden" name="pmto" value="<?php echo $pms['pmfrom']; ?>"/>
				</form>
			</td>
			<td>
				<form action="mr" method="POST">
					<input type="submit" class="button1" value="Delete"/>
					<input type="hidden" name="pmdel" value="<?php echo $pms['pmid']; ?>"/>
				</form>
			</td>
		</table>
		<?php
	}
}
$pmseen = mysqli_query($conn, "UPDATE mailbox SET seen=1 WHERE pmto='".$udata['username']."'") or die(mysqli_error($conn));
include("../privfiles/footer.php");?>