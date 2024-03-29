<?php
//1.  DB接続します
try {
$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ表示SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    //$resultにデータが入ってくるのでそれを活用して[html]に表示させる為の変数を作成して代入する
    $view .= "<p>";
    $view .= $result["id"].":".$result["bookname"].":".$result["bookurl"].":".$result["bookcomment"].":";
    $view .= "</p>";






    
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index2.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<!-- <?php
// $str_base = $status;
$str = explode(":",$view);
 var_dump($str);
//  $result2 = array($view);
//  $result3 = array_slice($view,1);

?> -->


<div>

<table rules="all" frame="box" boxcellpadding="10"> 
<tr>
<td>No</td>
<td>書籍名</td>
<td>書籍URL</td>
<td>書籍コメント</td>
</tr>


       <tr>
        
        <td><?php echo $str[0]; ?></td>
        <td><?php echo $str[1]; ?></td>
        <td><?php echo $str[2]; ?></td>
        <td><?php echo $str[3]; ?></td>
        
      
        </tr> 

</div>

  
  
 <div class="container jumbotron"><?=$view?></div>
</div>


<!-- Main[End] -->


</body>
