<?php
if($udata['level'] < 10){
	if($udata['exp'] >= (($udata['level'] +1) *50)){
		$udata['level'] += 1;
		$udata['nrgreg'] += 5;
		$udata['maxnrg'] += 100;
		$udata['energy'] = $udata['maxnrg'];
	}
}elseif($udata['level'] < 20){
	if($udata['exp'] >= (($udata['level'] -(13/2)) *200)){
		$udata['level'] += 1;
		$udata['nrgreg'] += 5;
		$udata['maxnrg'] += 100;
		$udata['energy'] = $udata['maxnrg'];
	}
}elseif($udata['level'] < 30){
	if($udata['exp'] >= (($udata['level'] -(47/3)) *750)){
		$udata['level'] += 1;
		$udata['nrgreg'] += 5;
		$udata['maxnrg'] += 100;
		$udata['energy'] = $udata['maxnrg'];
	}
}elseif($udata['level'] < 40){
	if($udata['exp'] >= (($udata['level'] -24) *2000)){
		$udata['level'] += 1;
		$udata['nrgreg'] += 5;
		$udata['maxnrg'] += 100;
		$udata['energy'] = $udata['maxnrg'];
	}
}elseif($udata['level'] < 50){
	if($udata['exp'] >= (($udata['level'] -29) *3000)){
		$udata['level'] += 1;
		$udata['nrgreg'] += 5;
		$udata['maxnrg'] += 100;
		$udata['energy'] = $udata['maxnrg'];
	}
}elseif($udata['level'] < 60){
	if($udata['exp'] >= (($udata['level'] -39) *6000)){
		$udata['level'] += 1;
		$udata['nrgreg'] += 5;
		$udata['maxnrg'] += 100;
		$udata['energy'] = $udata['maxnrg'];
	}
}
$udlvl = mysqli_query($conn, "UPDATE userstats SET level='".$udata['level']."', energy='".$udata['energy']."' nrgreg='".$udata['nrgreg']."', maxnrg='".$udata['maxnrg']."' WHERE id='".$_SESSION['uid']."'") or die(mysqli_error($conn));
?>