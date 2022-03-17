
<?php
 
    /*******************テーブルの作成*********************** */
    //投稿内容のデータ
    $sql = "CREATE TABLE IF NOT EXISTS massege"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "date TEXT"
    .");";
    $stmt1 = $pdo->query($sql);

    //登録内容のデータ
      $sql = "CREATE TABLE IF NOT EXISTS userdata"
      ." ("
      . "id int not null auto_increment primary key,"
      . "name char(32),"
      . "email varchar(255),"
      . "password varchar(255),"
      . "created timestamp not null default current_timestamp"
      .");";
      $stmt2 = $pdo->query($sql);
    /****************************************************** */
?>