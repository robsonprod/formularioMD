<?php
// define('HOST', "localhost");
// define('PASS', "RASmagate2009%%%");
// define('USER', "drayone1_obr");
// define('DTBS', "drayone1_obr");

define('HOST', "localhost");
define('PASS', "123");
define('USER', "root");
define('DTBS', "inscricao_obr");

$connect = mysql_connect(constant('HOST'), constant('USER'), constant('PASS')) or die ("Erro ao conectar <strong>".mysql_error()."</strong>");
$database = mysql_select_db(constant('DTBS')) or die ("Erro ao selecionar o Db <strong>".mysql_error()."</strong>");

if (!$connect) {
	die("Connection failed: ");
}

$data   = $_POST;
$email = htmlspecialchars(mysql_real_escape_string($data ['email']));

$query = "SELECT cad.email FROM inscricoes AS cad WHERE cad.email LIKE '%".$email."%'";
$exeqr = mysql_query($query) or die(mysql_error());
$validate = (mysql_num_rows($exeqr) <= 0) ? false : true;

echo $validade;

$values = '';
$intos = '';
$count = 0;
foreach ($_POST as $key => $value) {
	$intos .= htmlspecialchars($key);
	$values .=  "'" . htmlspecialchars($value) . "'";

	if (count($_POST) - 1 > $count) {	
		$intos .= ", ";
		$values .= ", ";
	}

	$count++;
}

$sql = "INSERT INTO inscricoes ($intos) VALUES ($values)";

if ($validate == true) {

	echo '<div style="border-radius: 4px; border: 1px solid #f2dede; padding: 15px 200px 15px 185px; background-color: #f2dede; border-color: #ebccd1; margin: 100px; color: #a94442;">O e-mail já está cadastrado.</div>';

}else if(mysql_query($sql)){

		// echo '<div style="border-radius: 4px;color: #3c763d;background-color: #dff0d8;border:1px solid #d6e9c6;padding: 15px;margin-bottom: 20px; margin: 100px;"><b>Sucesso!</b> 
		// Inscrição efetuada com sucesso.<br/>Aguarde o e-mail de confirmação.</div>'; 
	echo '<div style="border-radius: 4px;color: #3c763d;background-color: #dff0d8;border:1px solid #d6e9c6;padding: 15px 100px 15px 130px;margin-bottom: 20px; margin: 100px;"><b>Sucesso!</b> Inscrição efetuada com sucesso.<br/><br/>Aguarde o e-mail de confirmação.</div>'; exit();
}else{

	echo "problema no validade"; 

}



mysql_close($connect);

?>