<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body id = "all">

    <form action="form_num.php" method="post">
        <p><img src="captcha_num.php" id='img'>
            <a href="javascript:void(0)"
               onclick="document.getElementById('img').src='captcha_num.php'">
                看不清？
            </a>
        </p>
        <p><input type="text" name="code" value="" /></p>
        <p><input type="submit" style="padding: 10px" value="验证"/></p>
        <div id = "result"></div>
    </form>

    <?php
    session_start();

    if(isset($_POST['code'])){
        if($_POST['code'] == $_SESSION['code']){
            echo '<script>document.getElementById("all").innerHTML="";</script>';
            echo '<font>验证成功！</font>';
            exit;
        }else{
            echo '<script>document.getElementById("result").
            innerHTML="<p style=\'color:red\'>你输入的验证码有误！</p>";</script>';
        }
    }
    ?>
</body>
</html>