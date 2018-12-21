<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Регистрация нового пользователя</title>
</head>
<body>
	<div class="wrapper">
		<form action="addUser.php" method="post">
			<input type="text" name="username" placeholder="Введите ваш логин">
			<input type="password" name="password1" placeholder="Введите ваш пароль">
			<input type="password" name="password2" placeholder="Введите ваш пароль">
			<input type="email" name="email" placeholder="Введите вашу почту">
			<input type="submit" name="submit" value="Отправить">

		</form>
	</div>

<?php
 	$name = $_POST['username'] = trim($_POST['username']); 
  	$pass1 = $_POST['password1'] = trim($_POST['password1']); 
  	$pass2 = $_POST['password2'] = trim($_POST['password2']); 
  	$email = $_POST['email'] = trim($_POST['email']);
  	$submit = $_POST['submit'];

	if(empty($_POST['username'])) exit(); 
	if(empty($_POST['username'])) exit('Поле "Логин" не заполнено'); 
  	if(empty($_POST['password1'])) exit('Одно из полей "Пароль" не заполнено'); 
  	if(empty($_POST['password2'])) exit('Одно из полей "Пароль" не заполнено');
  	if($_POST['password1'] != $_POST['password2']) exit('Пароли не совпадают'); 

  	if(!empty($_POST['email'])){ 
    if(!preg_match("|^[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email'])) 
    { 
      exit('Поле "E-mail" должно соответствовать формату somebody@somewhere.ru'); 
    } 
  } 
  $filename = "users.csv";
  $arr = file($filename); 
  
  foreach($arr as $line){
  $data = explode("::",$line);  
  $temp[] = $data[0]; 
  } 

  if(in_array($_POST['username'], $temp)) { 
    exit("Данное имя уже зарегистрировано, пожалуйста, выберите другое"); 
  } 
  $fd = fopen($filename, "a"); 
  if(!$fd) exit("Ошибка при открытии файла данных"); 
  $str = $_POST['username']."::". 
         $_POST['password1']."::". 
         $_POST['password2']."::". 
         $_POST['email']."::". 
         $_POST['url']."\r\n"; 
  fwrite($fd,$str); 
  fclose($fd); 
  echo "<HTML><HEAD> 
         <META HTTP-EQUIV='Refresh' CONTENT='0; URL=$_SERVER[PHP_SELF]'> 
        </HEAD></HTML>"; 
?>	
</body>
</html>