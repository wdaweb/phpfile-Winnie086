<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳檔案機制
 * 3.取得檔案資源
 * 4.取得檔案內容
 * 5.建立SQL語法
 * 6.寫入資料庫
 * 7.結束檔案
 */
include_once "base.php";
// echo $_GET['do'];
if(!empty($_GET['do']) && $_GET['do']=='download'){
    $rows=all('students');

    //寫入BOM表頭
    $file=fopen('download.csv',"w+");
    $utf8_with_bom=chr(239).chr(187).chr(191);
    fwrite($file,$utf8_with_bom); 
    foreach($rows as $row){
        $line=implode(',',[$row['id'],$row['name'],$row['age'],$row['birthday'],$row['addr']]);
        fwrite($file,$line);
        echo $line."-已寫入<br>";
    }

    fclose($file);

    $filename="download.csv";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯出</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
table{
    width:50%;
    border-collapse:collapse;
    text-align:center;
    box-shadow:0 0 5px #999;
    margin:0 auto;
}
table td{
    padding:5px 10px;
    border:1px solid #999;
}
.download{
    display:block;
    width:100px;
    padding:5px 10px;
    border-radius:20px;
    box-shadow:0 0 5px #ccc;
    margin:10px auto;
    text-align :center;
}

</style>
<body>
<h1 class="header">文字檔案匯出練習</h1>
<!---建立檔案上傳機制--->



<!----讀出匯入完成的資料----->
<?php
$rows=all('students');
if(isset($filename)){
?>

<a href='download.csv' download>已能下載</a>

<?php
}
?>
<table>
    <tr>
        <td>姓名</td>
        <td>年齡</td>
        <td>生日</td>
        <td>居住地</td>
    </tr>

    <?php
    foreach($rows as $row){
    ?>

    <tr>
        <td><?=$row['name'];?></td>
        <td><?=$row['age'];?></td>
        <td><?=$row['birthday'];?></td>
        <td><?=$row['addr'];?></td>
    </tr>


    <?php
    }
    ?>


</table>
<a href="?do=download" class="download">Download</a>
</body>
</html>