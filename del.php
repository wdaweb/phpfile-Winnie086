<?php
include_once "base.php";

// 要刪除的id
$id=$_GET['id'];

// 檔案放在什麼位置(檔案路徑)
$row=find('upload',$id);
$path=$row['path'];

// 一併從我的資料夾刪除
unlink($path);


// 刪除資料表中的紀錄
del('upload',$id);

to('manage.php');
?>
