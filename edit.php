<?php


include_once "base.php";

// 判斷是讀取資料還是更新資料
if(!empty($_GET['id'])){
  
  $row=find('upload',$_GET['id']);
  
}


// 如果不是空的，代表有資料要更新
if(!empty($_POST)){
 
  $row=find('upload',$_POST['id']);
  
  if(!empty($_FILES['img']['tmp_name'])){
  $row['name']=$_FILES['img']['name']
  $subname="";
  $subname=explode(",",);
  $subname=array_pop($subname);
  $filename=date("Ymdhis").".".$subname;
  unlink($row['path']);

  $row['path']=".imgages/".$filename;
  move_uploaded_file($_FILES['img']['tmp_name'],$row['path']);

 }

  $row['type']=$_POST['type']
  $row['note']=$_POST['note']

}

save('upload',$row);
to('manage.php')

?>
<style>
   form{
        border:3px solid black;
        margin:0 auto;
    }



</style>


<form action="?" method="post" enctype="multipart/form-data">
    <div><img src="<?=$row['path'];?>" style="width:200px"></div>
    <div>上傳的檔案<input type="file" name="img"></div>
    <div>檔案說明<input type="text" name="note" value="<?=$row['note'];?>"></div>
   <div>檔案類型
    <select name="type">
    <option value="圖檔" <?=($row['type']=='圖檔')?'selected':'';?>>圖檔</option>
    <option value="文件">文件</option>
    <option value="其他">其他</option>
    </select>
    </div>
    <input type="hidden" value="">
    <input type="submit" value="更新">
</form>