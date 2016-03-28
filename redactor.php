<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
$host="localhost";
$user="root";
$pass=""; 
$db_name="CMS";
$link=mysql_connect($host,$user,$pass);
mysql_select_db($db_name,$link); 
if($link)
echo 'NORMALNO PODKLUCHENIE EST';
else
die('PLOHO NET PODKLYUCHENIYA');
 
if(isset($_GET['ID']))
{   
    $id = htmlentities(mysqli_real_escape_string($link, $_GET['ID']));
     
    // создание строки запроса
    $query ="SELECT * FROM info WHERE ID = '$id'"; //$query ="SELECT * FROM info WHERE ID = '$id'";
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    //если в запросе более нуля строк
    if($result && mysqli_num_rows($result)>0) 
    {
        $row = mysqli_fetch_row($result); // получаем первую строку
        $name = $row[1];
        $fname = $row[2];
         
        echo "<form method='POST'>
              <p>Введите имя:<br> 
              <input type='text' name='Name' value='$name' /></p>
              <p>Введите фамилию: <br> 
              <input type='text' name='Fname' value='$fname' /></p>
              <input type='submit' value='Сохранить'>
              </form>"; 
         
        mysqli_free_result($result);
    }
}



if(isset($_POST['Name']) && isset($_POST['Fname']) && isset($_POST['ID'])){
	
 
    $id = htmlentities(mysqli_real_escape_string($link, $_POST['ID']));
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['Name']));
    $fname = htmlentities(mysqli_real_escape_string($link, $_POST['Fname']));
     
    $query ="UPDATE info SET Name='$name', Fname='$fname' WHERE ID='$id'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 
    if($result)
        echo "<span style='color:blue;'>Данные обновлены</span>";
} 

// закрываем подключение
//mysqli_close($link);
?>
</body>
</html>