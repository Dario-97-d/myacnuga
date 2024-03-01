<head>
<title>MYACNUGA</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    window.onload = setupRefresh;
    function setupRefresh()
    {
        setInterval("refreshBlock();",30000);
    }
    
    function refreshBlock()
    {
       $('#gfeed').load("index.html");
    }
  </script>
</head>
<body>
<div align="center">
	<div id="header"><a href="index.php"><BR /><b>myacnuga</b></a></div>
	<div id="container">
		<div id="menu"><div id="menu_div">
		<?php
		session_start();
		include("functions.php");
		if(isset($_SESSION['uid'])){
			$udata_get = mysqli_query($conn, "SELECT u.*,a.*,g.*,r.*,s.* FROM user u JOIN useratts a ON u.id=a.id JOIN userguild g ON u.id=g.id JOIN userranks r ON u.id=r.id JOIN userstats s ON u.id=s.id WHERE u.id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
			$udata = mysqli_fetch_assoc($udata_get);
			?>
			<br /><a href="overview.php">Overview</a>
			<br /><a href="accsets.php">Account</a>
			<br />
			<br /><a href="guild.php">Guild</a>
			<br />
			<br /><a href="mp.php">Send PM</a>
			<?php
			$getnewpms = mysqli_query($conn, "SELECT pmid FROM mailbox WHERE pmto='".$udata['username']."' AND seen=0") or die(mysqli_error($conn));
			if(mysqli_num_rows($getnewpms) > 0){
				echo '<a href="mr.php"><u>Inbox</u></a>';
			}else{
				echo '<br /><a href="mr.php">Inbox</a>';
			}
			echo '<br /><a href="ms.php">Mail sent</a>';
			echo '<br /><br /><a href="ho.php">My battles</a>';
		}
		?>
		<br /><a href="ha.php">All Battles</a>
		<br />
		<br /><a href="rp.php">Player Ranks</a>
		<br /><a href="rg.php">Guild Ranks</a>
		</div></div>
		<div id="content"><div id="content_div">