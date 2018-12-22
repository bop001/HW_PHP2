<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
	<title>Регистрация нового пользователя</title>
</head>
<body>
  <div class="back">
		<a href="index.php">На главную</a>
  </div>
  <div class="wrapper">
    <form action="addUser.php" method="post">
      <label for="username">Логин:</label>
      <input type="text" id="username" name="username" placeholder="Введите ваш логин">
      <label for="password1">Пароль:</label>
      <input type="password" id="password1" name="password1" placeholder="Введите ваш пароль">
      <label for="password2">Пароль еще раз:</label>
      <input type="password" id="password2" name="password2" placeholder="Введите ваш пароль">
      <label for="email">Почта:</label>
      <input type="email" id="email" name="email" placeholder="Введите вашу почту">
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
      if(!preg_match("|^[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email'])) { 
      exit('Поле "E-mail" должно соответствовать формату somebody@somewhere.ru'); 
      } 
    }
   if (!empty($name) && !empty($pass1) && !empty($pass2) && !empty($email) && !empty($submit)) {
       echo '<div class="massage">"Поздравляю вы зарегистрированы"</div>';
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
  
?>	
</body>
</html>