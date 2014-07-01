<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php
$login = $_POST['login'];
$pass = $_POST['password'];
$id =  $_POST['id'];
$mpass = '1';
$muser = 'root';
$link = mysql_connect('localhost',$muser, $mpass) or die('Cant connect: '.mysql_error());
mysql_select_db('mydb') or die('Cant select database');
mysql_query("SET NAMES 'utf8'");
$query = sprintf("SELECT z.text from zayvki z join managers m on m.id = z.managers_id where z.number='%s' and m.name = '%s' and m.password = '%s'",mysql_real_escape_string($id), mysql_real_escape_string($login), mysql_real_escape_string($pass));
$result = mysql_query($query);
if(mysql_num_rows($result) == 0) {
	echo 'Wrong password or login or id, please try <p><a href="/">again</a></p>';
}
else{
	while($row = mysql_fetch_assoc($result)){
		$text = $row['text'];
		foreach(preg_split("/((\r?\n)|(\r\n?))/", $text) as $line){
			echo $line."<br/>";
		} 
	}
}
mysql_close($link);
?>
</body>
</html>
