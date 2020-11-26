<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */
 include_once "base.php";

if(empty($_FILES['img']['tmp_name'])){
// if(empty($_FILES['img←下面變數的名稱']['tmp_name'])){

}else{
    // echo "檔案原始名稱:".$_FILES['img']['name'];
    // echo "<br>檔案上傳成功";
    // echo "<br>原始上傳路徑:".$_FILES['img']['tmp_name'];
    
    $subname="";
    $subname=explode('.',$_FILES['img']['name']);
    echo $subname=array_pop($subname);
    // array_pop(取陣列最後一個元素)
    
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
    // print_r($_POST);

    // 把檔名改成我們自己的
    $filename=date("Ymdhis").".".$subname;

    // 搬到我們自己的images資料夾下，更改檔名
    move_uploaded_file($_FILES['img']['tmp_name'],"./images/".$filename);

    // echo照片大小
    // echo "<img src='./images/$filename' style='width:200px'>";

    
    $row=[
        "name"=>$_FILES['img']['name'],
        "path"=>"./images/".$filename,
        "type"=>$_POST['type'],
        "note"=>$_POST['note']
    ];

    // print_r($row);
    save("upload",$row);
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
    <style>
    table{
        border:3px double;
        border-collapse:collapse;
    }
    td{
        border:1px solid #555;
        padding:5px;
    }


    </style>
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 <!----建立你的表單及設定編碼----->

<form action="?" method="post" enctype="multipart/form-data">
    <div>上傳的檔案<input type="file" name="img"></div>
    <div>檔案說明<input type="text" name="note"></div>
   <div>檔案類型
    <select name="type">
    <option value="圖檔">圖檔</option>
    <option value="文件">文件</option>
    <option value="其他">其他</option>
    </select>
    </div>
    <input type="submit" value="上傳">
</form>

<!----建立一個連結來查看上傳後的圖檔---->  
<?php

// 拿到所有的圖檔，把table撈出來
$rows=all('upload');
echo "<table>";
echo "<td>縮圖</td>";
echo "<td>檔案名稱</td>";
echo "<td>檔案類型</td>";
echo "<td>檔案說明</td>";
echo "<td>下載</td>";

foreach($rows as $row){
    
    echo "<tr>";
    
    // 用if判斷是否為圖檔
    if($row['type']=='圖檔'){
    
        echo "<td><img src='{$row['path']}' style='width:100px'></td>";
        
    }else{

        echo "<td><img src='./images/file_icon.png' style='width:100px'></td>";
        
    }

    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['type']}</td>";
    echo "<td>{$row['note']}</td>";
    echo "<td><a href='{$row['path']}' download>下載</a></td>";
   



    echo "</tr>";
    
    
    
}

echo "</table>";


?>

</body>
</html>