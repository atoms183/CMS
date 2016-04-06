<!doctype html>
<html lang="ru">
<head>
<title>CMS PANEL</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
</head>
<body>



<a class="btn btn-primary" href="product_admin.php" role="button">На главную</a>
<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'CMS');

if (!mysql_connect(DB_HOST, DB_USER, DB_PASS)) {
    exit('Cannot connect to server');
}
if (!mysql_select_db(DB_NAME)) {
    exit('Cannot select database');
}

mysql_query('SET NAMES utf8');

function search ($query) 
{ 
    $query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 1) {
            $text = '<p>Слишком короткий поисковый запрос.</p>';
        } else if (strlen($query) > 50) {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } else { 
            $q = "SELECT * FROM info WHERE ID LIKE '%$query%'
                  OR Name LIKE '%$query%' OR Fname LIKE '%$query%'";

            $result = mysql_query($q);

            if (mysql_affected_rows() > 0) { 
                $row = mysql_fetch_assoc($result); 
                $num = mysql_num_rows($result);

                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';

                do {
                    // Делаем запрос, получающий ссылки на статьи
                    $q1 = "SELECT * FROM info WHERE id = '$row[ID]'";
                    $result1 = mysql_query($q1);

                    if (mysql_affected_rows() > 0) {
                        $row1 = mysql_fetch_assoc($result1);
                    }

                    $text .= '<p><a> Результат поиска по запросу :'.$row1['ID'].'&nbsp'.$row['Name'].'&nbsp'.$row['Fname'].'</a></p>';

                } while ($row = mysql_fetch_assoc($result)); 
            } else {
                $text = '<p>По вашему запросу ничего не найдено.</p>';
            }
        } 
    } else {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text; 
} 
?>
<?php 
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
?>

</body>
</html>