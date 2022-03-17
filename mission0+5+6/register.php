<?php

session_start();

try {
    require_once('config.php');
    require_once("db_conect.php");
    require('make_table.php');
   
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

$password = $_SESSION["password"];
$email = $_SESSION["email"];

//認証コードと一致する場合登録する。
if ($_SESSION['round']==$_POST["authcode"]) {
    $stmt = $pdo->prepare("insert into userdata(email, password) value(?, ?)");
    $stmt->execute([$email, $password]);
?>  
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="shinjin.css">
    <body id="log_body">
        <main class="main_log">
            <p>登録完了</p>
            <h1 style="text-align:center;margin-top: 0em;margin-bottom: 1em;" class="h1_log">ログインしてください</h1>
            <form action="login.php" method="post" class="form_log">
                <!--<label for="email" class="label">メールアドレス</label><br>-->
                <input type="email" name="email" class="textbox un" placeholder="メールアドレス"><br>
                <!--<label for="password" class="label">パスワード</label><br>-->
                <input type="password" name="password" class="textbox pass" placeholder="パスワード"><br>
                <button type="submit" class="log_button">ログインする</button>
            </form>
            <p align="center">戻るボタンや更新ボタンを押さないでください</p>
    </body>
<?php
}else{
?>
<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

    <body id="log_body">
        <main class="main_log">
            <p>認証コードがあってません。</p>
            <form action="register.php" method="post">
                <input type="text" name="authcode" placeholder="認証コードを入力してください" width="300px">
                <input type="submit" name="submit_authcode" value="送信">
            </form>
        </main>
    </body>
<?php
    return false;
}
?>