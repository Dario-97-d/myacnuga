<?php
include("../privfiles/in.php");
if(!isset($_SESSION['uid'])){
	?>
	<div id="title">Login</div>
	<?php
}
if(isset($_POST['login'])){
	if(isset($_SESSION['uid'])){
		header("Location: overview.php");
	}else{
		$username = prot($conn, $_POST['username']);
		$password = prot($conn, $_POST['password']);
		$login_check = mysqli_query($conn, "SELECT id FROM user WHERE username='$username' AND password='".md5($password)."'") or die(mysqli_error($conn));
		if(mysqli_num_rows($login_check) != 1){
			output("Invalid Username/Password Combination!");
		}else{
			$login_id = mysqli_fetch_assoc($login_check);
			$_SESSION['uid'] = $login_id['id'];
			header("Location: overview.php");
		}
	}
}
if(!isset($_SESSION['uid'])){
	?>
	<br />
	<form action="index.php" method="POST">
		Username: <br /><input type="text" name="username"/><br />
		Password: <br /><input type="password" name="password"/><br />
		<br /><input type="submit" class="button1" name="login" value="Login"/>
	</form>
	<a href="register.php">Register</a>
	<br />
	<hr>
	<?php
}
echo "<br />myacnuga info";
include("../privfiles/footer.php");
?>