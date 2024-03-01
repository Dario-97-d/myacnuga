<?php
if($udata['level'] < 10){
	echo ($udata['level'] +1) *50;
}elseif($udata['level'] < 20){
	echo ($udata['level'] -(13/2)) *200;
}elseif($udata['level'] < 30){
	echo ($udata['level'] -(47/3)) *750;
}elseif($udata['level'] < 40){
	echo ($udata['level'] - 24) *2000;
}elseif($udata['level'] < 50){
	echo ($udata['level'] - 29) *3000;
}elseif($udata['level'] < 60){
	echo ($udata['level'] - 39) *6000;
}else{
	echo "This is max.";
}
?>