<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */

date_default_timezone_set("Asia,Taipei");


if(empty($_FILES['img']['tmp_name'])){
// if(empty($_FILES['img下面變數的名稱']['tmp_name'])){

}else{
    echo "檔案原始名稱:".$_FILES['img']['name'];
    echo "<br>檔案上傳成功";
    echo "<br>原始上傳路徑:".$_FILES['img']['tmp_name'];
    
    $subname="";
    $subname=explode('.',$_FILES['img']['name']);
    echo $subname=array_pop($subname);

    
    
    
    // 用switch取得副檔名
    // switch($_FILES['img']['type']){
        
        //     case "image/jpeg":
            //         $subname=".jpg";
            //     break;
            
            //     case "image/png":
                //         $subname=".png";
                //     break;
                
                //     case "image/gif":
                    //         $subname=".gif";
                    //     break;
                    // }
    
                    
    $filename=date("Ymdhis").".".;
    move_uploaded_file($_FILES['img']['tmp_name'],"./images/".$_FILES['img']['name']);

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 <!----建立你的表單及設定編碼----->

<form action="?" method="post" enctype="multipart/form-data">
    <input type="file" name="img">
    <input type="submit" value="上傳">
</form>





<!----建立一個連結來查看上傳後的圖檔---->  


</body>
</html>