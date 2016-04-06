<!doctype html>
<html lang="ru">
<head>
<title>CMS PANEL</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

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


<div class="test">
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

</div>
<div class="container">

  <div class="card"></div>
  <div class="card">
    <h1 class="title">Добавление данных</h1>
<form action="" method="post">
        <div class="input-container">
        <input type="text" name="ID" required>
        <label for="Username">Введите ваш ID</label>
        <div class="bar"></div>
      </div>


       <div class="input-container">
       <input type="text" name="Name" required>
      <label for="Username">Введите ваше имя</label>
        <div class="bar"></div>
      </div>

      <div class="input-container">         
       <input type="text" name="Fname" required>
      <label for="Username">Введите вашу фамилию</label>
       <div class="bar"></div>
      </div>


 <div class="button-container">
        <button><span>Добавить</span></button>
      </div>
  
</form>


 </div>
  <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">Поиск
      <div class="close"></div>
    </h1>
    <form name="search" method="post" action="search.php">
<div class="input-container">
    <input type="search" name="query"required>
     <label for="Username">Введите данные</label>
       <div class="bar"></div>
     
    </div>
  <div class="button-container">
        <button><span>Найти</span></button>
      </div>

</form>
  </div>
</div>




    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>
</body>