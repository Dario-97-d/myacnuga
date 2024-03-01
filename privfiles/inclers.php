<head>
<title>MYACNUGA</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
function ddfmain() {
    document.getElementById("maindd").classList.toggle("show");
}

function ddfrank() {
    document.getElementById("rankdd").classList.toggle("show");
}

function ddfhist() {
    document.getElementById("histdd").classList.toggle("show");
}

function ddfmail() {
    document.getElementById("maildd").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.ddlink')) {

    var dropdowns = document.getElementsByClassName("ddcont");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
</head>
<body>
<div id="header"><center><a href="index.php">myacnuga</a></center></div>
<div id="navbar">
<?php
session_start();
include("functions.php");
if(isset($_SESSION['uid'])){
	$udata_get = mysqli_query($conn, "SELECT u.*,a.*,g.*,r.*,s.* FROM user u JOIN useratts a ON u.id=a.id JOIN userguild g ON u.id=g.id JOIN userranks r ON u.id=r.id JOIN userstats s ON u.id=s.id WHERE u.id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
	$udata = mysqli_fetch_assoc($udata_get);
	?>
	<div class="dropdown">
		» <span onclick="ddfmain()" class="ddlink">Main</span> «
		<div id="maindd" class="ddcont">
			<a href="mainhome.php">Home</a>
			<a href="mainguild.php">Guild</a>
			<a href="mainsettings.php">Settings</a>
		</div>
	</div>
	<?php
}
?>
<div class="dropdown">
	» <span onclick="ddfrank()" class="ddlink">Ranking</span> «
	<div id="rankdd" class="ddcont">
		<a href="rankp.php">Player Ranks</a>
		<a href="rankg.php">Guild Ranks</a>
	</div>
</div>
<?php
if(isset($_SESSION['uid'])){
	?>
	<div class="dropdown">
		» <span onclick="ddfhist()" class="ddlink">History</span> «
		<div id="histdd" class="ddcont">
			<a href="histown.php">Own battles</a>
			<a href="histall.php">All battles</a>
		</div>
	</div>
	<?php
	$getnewpms = mysqli_query($conn, "SELECT pmid FROM mailbox WHERE pmto='".$udata['username']."' AND seen=0") or die(mysqli_error($conn));
	if(mysqli_num_rows($getnewpms) > 0){
		?>
		<div class="dropdown">
			» <span onclick="ddfmail()" class="ddlink" style="text-decoration: underline">Mail</span> «
			<div id="maildd" class="ddcont">
				<a href="mailbox.php" style="color: #770000;">Inbox</a>
				<a href="mailsent.php">Mail sent</a>
				<a href="mailsend.php">Send Mail</a>
			</div>
		</div>
		<?php
	}else{
		?>
		<div class="dropdown">
			» <span onclick="ddfmail()" class="ddlink">Mail</span> «
			<div id="maildd" class="ddcont">
				<a href="mailbox.php">Inbox</a>
				<a href="mailsent.php">Mail sent</a>
				<a href="mailsend.php">Send Mail</a>
			</div>
		</div>
		<?php
	}
}else{
	echo '|» <a href="register.php" style="text-decoration: underline">Sign up</a> «';
}
?>
</div>
<div id="content">
<br /><br />