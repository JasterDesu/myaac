<?php

if($_GET && $_GET['status'] && $_GET['status'] == "success"){
	die(header('Location: /?thanks'));
}else{
	die(header('Location: /?jpaydonate'));
}



// $a = $_GET;
// foreach($a as $b => $c){
	// echo $b.$c."<br>";
// }
// echo "<br>";
// echo json_encode($a);
?>