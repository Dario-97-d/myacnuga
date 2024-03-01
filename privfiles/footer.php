</div></div>
</div>
<div id="footer">
<?php
if(isset($_SESSION['uid'])){
	?>
	<br />
	<form action="logout.php" method="POST">
	<input type="submit" class="button1" name="logout" value="Logout"/>
	</form>
	<?php
}
echo "Turns every 30 min<br />" . date("d/m H:i:s") . "<br />&copy; 2017-2018";
?>

</div>
</body>
</html>