<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳圖案機制
 * 3.取得圖檔資源
 * 4.進行圖形處理
 *   ->圖形縮放
 *   ->圖形加邊框
 *   ->圖形驗證碼
 * 5.輸出檔案
 */
if(!empty($_FILES['photo']['tmp_name'])){
    echo "檔案:".$_FILES['photo']['tmp_name']."<br>";
    echo "格式:".$_FILES['photo']['type']."<br>";
    echo "大小:".round($_FILES['photo']['size']/1024)."<br>";
    move_uploaded_file($_FILES['photo']['tmp_name'],"./img/".$_FILES['photo']['name']); //移動檔案
    $filename;
    $src_info=[
        'width'=>0;
        'height'=>0;
    ];
    $dst_img=[

    ];


    switch($_FILES['photo']['type']){

        case "image/jpeg";
        imagecreatefromjpeg($filename);
        break;
        case "image/png";
        imagecreatefrompng($filename);
        break;
        case "image/gif";
        imagecreatefromgif($filename);
        break;
        default:
        echo "只接受圖檔";
        exit();
        
    }
    $src_info['width']=imagesx($src_img);
    $src_info['height']=imagesy($src_img);
    $src_info['rate']=imagesy($src_img)/imagesx($src_img);
    if($src_info['rate']<=1){
        $src_info['direction']='Landscape';
    }else{
        $src_info['direction']='Portrait';
    }

    $dst_img=imggecreatetruecolor(200,200);
    $dst_info['width']=200;
    $dst_info['height']=200;

    $white=imagecolorallocate($dst_img,255,255,255);
    imagefill($dst_img,0,0,$white);

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形處理練習</title>
    <link rel="stylesheet" href="style.css">
    <style>
    div{
        width:500px;
        margin:10px auto;
        text-align:center;
    }
    </style>
</head>
<body>
<h1 class="header">圖形處理練習</h1>
<!---建立檔案上傳機制--->
<form action="?" method="post" enctype="multipart/form-data">
    <input type="file" name ="photo" accept="image/gif, image/png, image/jpeg" >
    <input type="submit" value="上傳">
</form>

<h3>原始圖形</h3>
<div>
<img src="<?="./img/".$_FILES['photo']['name'];?>" style="width:250px">
</div>
<!----縮放圖形----->
<h3>縮放圖形</h3>

<hr>

<?php 
if(isset($src_img) && isset($dst_img)){

    if($scr_info['direction']=='Landscape'){

        $dst_height=$dst_info['height']*$src_info['rate'];
        $dst_width=$dst_info['width']*$src_info['rate'];
        $dst_y=($dst_info['height']*$dst_height)/2;
        $dst_x=0;
        
    }else{
        
        $dst_height=$dst_info['height'];
        $dst_width=$dst_info['width']*(1/$src_info['rate']);
        $dst_y=0;
        $dst_x=($dst_info['width']-$dst_width)/2;

    }


    imagecopyresampled($dst_img,$src_img,$dst_info_x,$dst_info_y,0,0,$dst_width,$dst_height,$src_info['width'],$src_info['height']);
    $dst_path="./dst/".$FILES['photo']['name'];
    imagejpeg($dst_img,$dst_path);
}
?>

<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>