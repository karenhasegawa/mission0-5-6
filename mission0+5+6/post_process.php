<?php

    require("config.php");
    require("db_conect.php");
    require("make_table.php");

    //定数設定
    /////////define("FILE","./database_2.txt");

    //初期値設定
    $delete_num = "";
    $delete_pass = "";
    $edit_num = "";
    $edit_pass = "";

    /***************************************************************** 
     *                      各入力による分岐                           *
    ******************************************************************/
    /*-----送信が押されたとき-----*/
    if(!empty($_POST["new_submit"])&&!empty($_POST["number"]))Edit_Submit2();
    else if(!empty($_POST["new_submit"]))New_Submit();
    /*-----削除が押されたとき-----*/
    else if(!empty($_POST["delete_submit"])){
        if(!empty($_POST["delete"])){
            $delete_num = $_POST["delete"];
            $anser = PassWord($delete_num,$_SESSION['password']);
        }
        if($anser == "パスワードが一致しました。")Delete_Submit();
        else echo "もう一度記入してください。";
    }
    /*------編集が押されたとき------*/
    else if(!empty($_POST["edit_submit"])){
        if(!empty($_POST["edit"])){
            $edit_num = $_POST["edit"];
            $edit_pass = $_SESSION['password'];
        }
        $anser = PassWord($edit_num,$edit_pass);
        echo $anser."<br>";
        if($anser == "パスワードが一致しました。")Edit_Submit();
        else echo "もう一度記入してください。";
    }

    /***************************************************************
     *                      各機能の関数                            *
     ***************************************************************/                
    function New_Submit(){

        global $pdo;

        //ファイルの読み込み
        //$line_new = Read_db();
        //echo "最後の行:".$line[count($line)-1]."<br>";

        /* //投稿ナンバーの取得
        $line_last = $line_new[count($line_new)-1];
                /////$line_last = explode("<>",$line_last,6);
        $id_number = $line_last["id"];
        //echo $id_number;*/
        
        /*************投稿する内容の保存***********/
        if(!empty($_SESSION["name"]) && !empty($_POST["comment"])){

            //$id_number += 1;
            //////$date =  date("Y-m-d H:i:s");             
            //$id_number_date = $id_number."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$date."<>".$_POST["pass_main"]."<>";
            
            /*$fp = fopen(FILE,"a");
            fwrite($fp,$id_number_date.PHP_EOL);
            fclose($fp);*/

            /********************データ（レコード）を登録********************* */
            $name = $_SESSION["name"];
            $comment = $_POST["comment"]; //好きな名前、好きな言葉は自分で決めること
            $date =  date("Y-m-d H:i:s");
            $sql = $pdo -> prepare("INSERT INTO massege (name, comment, date) VALUES (:name, :comment, :date)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':date', $date, PDO::PARAM_STR);
            $sql -> execute();
            //bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう
            /******************************************************* */

            /*
                INSERT INTO Massege
                VALUES
                ('name','comment','date','password');
            */
        }

        return 0;
    }

    function Delete_Submit(){

        if(!empty($_POST["delete"])){

            global $pdo;

            $delete = $_POST["delete"];

            //ファイルの読み込み
            $line_delete=Read_db();

            /*//上書き
            $fp = fopen(FILE,"w");*/
            $count=0;
            foreach($line_delete as $row){
            // $lines = explode("<>",$i,6);

            if($row["id"]==$delete){

                $id = $delete;
                $sql = 'delete from massege where id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $count = 1;
                
            }
            /*else {
                //fwrite($fp,$i.PHP_EOL);
                
            }*/
            }
            if($count==0){
                echo "新規を入力して下さい。";
                return 0;
            }
                                                                                    
            //fclose($fp);
            
            /*
                SELECT id
                FROM item_purchase_log
                WHERE item_category = 'food'
                ;
                */



        }

        return 0;

    }
    
    function Edit_Submit(){

        $lines_edit=Read_db();
        
        //valueに代入
        foreach($lines_edit as $lines){
            //$lines = explode("<>",$i,6);
            if($lines["id"]==$_POST["edit"]){
                $c="'";
                $c.=$lines["comment"];$nm=$lines["id"];
                $c.="'";
                echo <<<EOM
                    <script type='text/javascript'>
                        element_2.value={$c};
                        element_3.value={$nm};
                        element_3.type="number";
                    </script>
                EOM;
            }
        }
        
        return 0;
    }

    function Edit_Submit2(){

        global $pdo;
        $line_edit=Read_db();
        $edit_num=$_POST["number"];
        $edit_comment=$_POST["comment"];

        //上書き
        //$fp = fopen(FILE,"w");
        $count=0;
        foreach($line_edit as $lines){
            //$lines = explode("<>",$i,5);
            if($lines["id"]==$edit_num){ 
                //$i=$edit_num."<>".$edit_name."<>".$edit_comment."<>".$date."<>".$edit_pass;
                
                $id = $edit_num; //変更する投稿番号
                $comment = $edit_comment; //変更したい名前、変更したいコメントは自分で決めること
                $date = date("Y-m-d H:i:s");
                $sql = 'UPDATE massege SET id=:id,comment=:comment,date=:date WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->execute();

                $count += 1;
            }
            //fwrite($fp,$i.PHP_EOL);
        }
        if($count==0){
            echo "編集する番号がないので新規登録します";
            New_Submit();
        }

        return 0;
        
    }

    function PassWord($num,$pass){

        $lines = Read_db();

        foreach($lines as $line){
            //$i = explode("<>",$line,6);
            if($line["id"]==$num){ 
                
                $pdo = new PDO(DSN, DB_USER, DB_PASS);
                $stmt = $pdo->prepare('select * from userdata where name = ?');
                $stmt->execute([$line["name"]]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($pass==$row['password']){
                    echo "<script type='text/javascript'>alert('パスワードは一致しています');</script>";
                        return "パスワードが一致しました。";
                }else{
                    echo "<script type='text/javascript'>alert('パスワードが合っていません');</script>";
                        return "パスワードが合っていません";
                }
            }                   
        }
        echo "その投稿番号はありません";
    }

    function Read_db(){

        global $pdo;

        /**テーブルに登録されたデータを取得し、表示*/
        $sql = 'SELECT * FROM massege';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
                /*foreach ($results as $row){
                    //$rowの中にはテーブルのカラム名が入る
                    echo $row['id'].',';
                    echo $row['name'].',';
                    echo $row['comment'].'<br>';
                    echo "<hr>";
                }*/
        return $results;
                
    }

    /**************************************************************** 
    function Read_File(){

        //ファイルエラーチェック
        if(!file_exists(FILE)){
            echo "<script type='text/javascript'>alert('データファイルがありません');</script>";
        }

        //ファイルの読み込み
        $line = file(FILE,FILE_IGNORE_NEW_LINES);
        
        return $line;

    }
    ********************************************************************/
    
    function view(){

        $lines_view=Read_db();
        
        //ファイル内容表示
        foreach($lines_view as $row){
        
                $n=$row["name"];$c=$row["comment"];$nm=$row["id"];
                echo <<<EOM
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', function(){
                            post_view.insertAdjacentHTML('afterbegin', '<div class="post_text"> $nm ,$n ,$c</div><hr>');
                        })
                    </script>
                EOM;

        }

        return 0;
    }

    echo "<br><br>";
    view();
    
?>