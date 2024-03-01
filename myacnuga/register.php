<?php
include("../privfiles/in.php");
?>
<div id="title">Register</div>
<?php
if(isset($_SESSION['uid'])){
	header("Location: overview.php");
}else{
	if(isset($_POST['register'])){
		$username = prot($conn, $_POST['username']);
		$password = prot($conn, $_POST['password']);
		$email = prot($conn, $_POST['email']);		
		if($username == "" || $password == "" || $email == ""){
			output("All fields are needed!");
		}elseif(strlen($username) > 16 || strlen($username) < 4){
			output("Username must be min. 4, max. 16 characters long.");
		}elseif(strlen($password) > 32 || strlen($password) < 8){
			output("Password must be min. 8, max. 32 characters long.");
		}elseif(strlen($email) > 48 || strlen($email) < 8){
			output("E-mail must be min. 8, max. 48 characters long.");
		}else{
			$regun = mysqli_query($conn, "SELECT id FROM user WHERE username='$username'") or die(mysqli_error($conn));
			$regem = mysqli_query($conn, "SELECT id FROM user WHERE email='$email'") or die(mysqli_error($conn));
			if(mysqli_num_rows($regun) > 0){
				output("This username is already in use");
			}elseif(mysqli_num_rows($regem) > 0){
				output("This e-mail address is already in use");
			}else{
				$ins1 = mysqli_query($conn, "INSERT INTO user (username,password,email,pdesc) VALUES ('$username','".md5($password)."','$email','Player Description')") or die(mysqli_error($conn));
				$ins2 = mysqli_query($conn, "INSERT INTO useratts (flair,sense,dexterity,agility,strength) VALUES (5,5,5,5,5)") or die(mysqli_error($conn));
				$ins3 = mysqli_query($conn, "INSERT INTO userguild (gid,grank,gapp) VALUES (0,'none',0)") or die(mysqli_error($conn));
				$ins4 = mysqli_query($conn, "INSERT INTO userranks (wins,battles,winpc) VALUES (0,0,0)") or die(mysqli_error($conn));
				$ins5 = mysqli_query($conn, "INSERT INTO userstats (level,exp,energy,nrgreg,maxnrg) VALUES (1,0,100,5,100)") or die(mysqli_error($conn));
				header("Location: index.php");
			}
		}
	}
		?>
		<br />
		<form action="register.php" method="POST">
		Username: <br /><input type="text" name="username" maxlength="16"/><br />
		Password: <br /><input type="password" name="password"/><br />
		E-mail: <br /><input type="email" name="email" maxlength="48"/><br />
		<br /><input type="submit" class="button1" name="register" value="Register"/>
		</form>
		<?php
}
include("../privfiles/footer.php");
?>