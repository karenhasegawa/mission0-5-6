<a href="myprofile.php">TOPページ</a>
<?php
    session_start();
    echo "<h3>".$_SESSION['name']."様の投稿履歴</h3>";
?>
    <form class="form1" action="" method="post">
    コメント<br>
    <input id="form_comment" type="text" name="comment" value="コメント" placeholder="コメントを入力してください" width="300px"><br>
    <input id="form_number" type="hidden" name="number" placeholder="投稿番号" width="300px"><br>
    <input type="submit" name="new_submit" value="送信"><br>
    </form>
    <form class="form1" action="" method="post">
        削除する投稿ナンバーを記入してください<br>
        <input type="number" name="delete" placeholder="削除番号" width="300px">
        <input type="submit" name="delete_submit" value="削除"><br>
    </form>
    <form class="form1" action="" method="post">
        編集する投稿ナンバーを記入してください<br>
        <input type="number" name="edit" placeholder="編集番号を入力して下さい" width="300px">
        <input type="submit" name="edit_submit" value="編集"><br>
    </form>
    <script type='text/javascript'>
            let element_2 = document.getElementById('form_comment');
            let element_3 = document.getElementById('form_number');
    </script>
<?php
    require("post_process.php");
    
    //指定ユーザーの投稿を表示
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from massege where name = :name');
    $stmt->bindValue(':name', $_SESSION['name']);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo $row["id"].",".$row["name"].",".$row["comment"].",".$row["date"]."<hr>";
    }


?>