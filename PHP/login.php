<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ��脣����餃�亥”��格��鈭斤��鞈����
    $phone = $_POST['phone'];
    $password1 = $_POST['password1'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bar";

    // 撱箇�����鞈����摨怎��������
    $conn = new mysqli($servername, $username, $password, $database);

    // 瑼Ｘ�仿����交�臬�行�����
    if ($conn->connect_error) {
        die("�����亙仃���: " . $conn->connect_error);
    }

    // ��瑁����餃�亦��SQL隤����
    $sql = "SELECT * FROM `user` WHERE `account`   = '$phone' AND `password` = '$password1'";

    $result = $conn->query($sql);

    $query = "SELECT `user_id` FROM `user` WHERE `account`   = '$phone' AND `password` = '$password1'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['user_id'];
    } else {
        $userID = ""; // 憒������芣�曉�啣�寥�����蝏����嚗���臭誑霈曄蔭銝�銝芷��霈文�潭����������嗡�����敶�������雿�
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BAR HOPPER Login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-image: url("bar.png");
            background-size: 100% auto; 
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .form input {
            padding: 5px;
            width: 220px;
            margin-bottom: 10px;
            color: black;
            background-color: white;
            border: none;
            border-radius: 3px;
        }
        
        .form .login-button,
        .form .register-button {
            margin-top: 10px;
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
        }

        .form input[type="text"]:focus, .form input[type="password"]:focus{
        border-color: #2ecc71;
        width: 280px;
        transition: 0.5s;
        }
                
    </style>
</head>

<body>
    <div class="container">
        <div class="letter" style="font-size: 75px; margin-bottom: 50px;" ><b>BAR HOPPER</b></div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form">
            <label for="text">撣唾��嚗�</label>
            <input type="text" name="phone" required placeholder="頛詨�亙董���" style="font-size: 20px;">
            <br>
            <label for="password">撖�蝣潘��</label>
            <input type="password" name="password1" required placeholder="頛詨�亙��蝣�" style="font-size: 20px;">
            <br>
            <input type="submit" name="login" value="��駁��" /></br>
            <br>
            <a href="register.php">閮餃��</a>
            <a href="admin.php">蝞∠�������餃��</a>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if ($result->num_rows > 0) {
            // ��餃�交�����嚗���脣��雿輻�刻��ID��袖ession
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $userID;
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['permission'] = 'B';
            
            header("Location:Bar_search.php?cid=$userID&rid=$userID"); // ��餃�亙��撠����擐����
            exit();
          } else {
            echo '<p>��餃�亙仃���嚗�隢�瑼Ｘ�亙董������撖�蝣潦��</p>';
          }
          }
          ?>

        </div>
    </div>
</body>

</html>