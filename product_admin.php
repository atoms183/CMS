<!doctype html>
<html lang="ru">
<head>
<title>CMS PANEL</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
$host="localhost";
$user="root";
$pass=""; 
$db_name="CMS";
$link=mysql_connect($host,$user,$pass);
mysql_select_db($db_name,$link);

//Если переменная Name передана
if (isset($_POST["Name"])) {
    //Тут идет запрос
    $sql = mysql_query("INSERT INTO `info` (`Name`, `Fname`, `ID`) 
                        VALUES ('".$_POST['Name']."','".$_POST['Fname']."','".$_POST['ID']."')");
    //Успех
    if ($sql) {
        echo "<p>Ваши данные успешно добавлены.</p>";
    } else {
        echo "<p>Произошла ошибка.</p>";
    }
}
?>
 

<a class="btn btn-primary" href="product_admin.php" role="button">На главную</a>



<div class="container">
	<div class="row">

		
	
<div class="sea">
<form action="" method="post">
        Введите ваш ID:
        <input type="text" name="ID" class="feedback-input" required>

       Введите ваше Имя:
       <input type="text" name="Name" class="feedback-input" required>

   Введите вашу Фамилию:
       <input type="text" name="Fname" class="feedback-input" required>



       <input type="submit" value="Добавить Данные">


  
</form>

<form name="search" method="post" action="search.php">
Введите данные
    <input type="search" name="query" class="feedback-input" required>
    <button type="submit">Найти</button> 
</form>
</div>
</div>
</div>

<?php
//Удаление
if (isset($_GET['del'])) {
    $sql = mysql_query('DELETE FROM `info` WHERE `ID` = "'.$_GET['del'].'"');
    if ($sql) {
        echo "<p>Пользователь удален!</p>";
    } else {
        echo "<p>Произошла ошибка.</p>";
    }
}

//Получение данных
$sql = mysql_query('SELECT `ID`, `Name`, `Fname` FROM `info`');
while ($result = mysql_fetch_array($sql)) {
    echo $result['ID'].") ".$result['Name']."&nbsp".$result['Fname']." - <a href='?del=".$result['ID']."'>Удалить</a>". "  <a href=redactor.php>Редактировать</a><br>";
}

?>

</body>