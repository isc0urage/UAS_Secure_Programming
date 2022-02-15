<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <?php include("./randomstringgenerator.php"); ?>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "secprog_uas";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        echo "gaada";
    } else {
    }
    $sql = "SELECT * FROM n2_users";
    $result = $conn->query($sql);
    echo "<table style='width:100%'>";
    echo "<tr><th>ID User</th><th>Username</th><th>Password</th><th>Last Login</th><th>Last Access Features</th><th>Action</th></tr>";
    $random = generateRandomString();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th>" . $row['ID User'] . "</th>";
            $id = $row['ID User'];
            echo "<th>" . $row['Username'] . "</th>";
            $hashed = $row['Password'] . $random;
            echo "<th>" . md5($hashed) . "</th>";
            echo "<th>" . $row['Last Login'] . "</th>";
            echo "<th>" . $row['Last Access Features'] . "</th>";
            echo "<th>" . "<a href='?id=$id&question=edit'>Edit</a>  <a href='?id=$id&question=delete'>Delete</a>" . "</th>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }

    echo "</table><br><br>";
    if (isset($_GET['id']) && $_GET['question'] == 'edit') {
        $id = $_GET["id"];
        $sql = "SELECT * FROM `n2_users` WHERE `ID User` = '$id'";
        $result = $conn->query($sql);
        $iduser = "";
        $username = "";
        $test = "";
        $lastlogin = "";
        $lastaccess = "";
        while ($row = $result->fetch_assoc()) {
            $iduser = $row["ID User"];
            $username = $row["Username"];
            $test = $row['Password'];
            $lastlogin = $row['Last Login'];
            $lastaccess = $row["Last Access Features"];
        }
    ?>
        <form method="post">
            <label for="q1">Confirm Old Password:</label><br>
            <input type="text" id="qn1" name="q1" value="jangannyontek"><br>
            <label for="q2">New Password:</label><br>
            <input type="text" id="q2" name="q2" value="A$b12345678"><br>
            <label for="q3">Verify New Password:</label><br>
            <input type="text" id="qn3" name="q3" value="A$b12345678"><br>
            <input type="submit" value="Submit">
        </form>
    <?php
        $gagal = 0;
        if (isset($_POST["q1"]) && isset($_POST["q2"]) && isset($_POST["q3"])) {
            // echo $_POST["q1"] . $_POST["q2"] . $_POST["q3"];
            if ($_POST["q1"] == $test) {
            } else {
                echo "password tidak sama<br><br>";
                $gagal++;
            }
            if ($_POST["q2"] == $_POST["q3"]) {
            } else {
                echo "password baru tidak sama<br><br>";
                $gagal++;
            }

            $str = $_POST["q2"];
            $re = '/[A-Z]/';
            if (preg_match($re, $str) != 1) echo $gagal++;
            $re = '/[a-z]/';
            if (preg_match($re, $str) != 1) echo $gagal++;
            $re = '/[$&+,:;=?@#|\'<>.^*()%!-]/';
            if (preg_match($re, $str) != 1) echo $gagal++;
            if (strlen($str) < 10) echo $gagal++;

            if ($gagal == 0) {
                $sql = "INSERT INTO n2_usersoldpassword VALUES ('$iduser', '$username', '$test', '$lastlogin', '$lastaccess')";
                $result = $conn->query($sql);
                $sql = "UPDATE n2_users SET `Password`='$str' WHERE `ID User`='$id'";
                $result = $conn->query($sql);
            }
        }
    }
    if (isset($_GET['id']) && $_GET['question'] == 'delete') {
        $id = $_GET["id"];
        $sql = "SELECT * FROM `n2_users` WHERE `ID User` = '$id'";
        $result = $conn->query($sql);
        $iduser = "";
        $username = "";
        $test = "";
        $lastlogin = "";
        $lastaccess = "";
        while ($row = $result->fetch_assoc()) {
            $iduser = $row["ID User"];
            $username = $row["Username"];
            $test = $row['Password'];
            $lastlogin = $row['Last Login'];
            $lastaccess = $row["Last Access Features"];
        }
        $gagal = 0;
        if ($gagal == 0) {
            $sql = "INSERT INTO `n2_usersdeleted` VALUES ('$iduser', '$username', '$test', '$lastlogin', '$lastaccess')";
            $result = $conn->query($sql);
            $sql = "DELETE FROM `n2_users` WHERE `ID User` = '$id'";
            $result = $conn->query($sql);
        }
    }
    ?>



</body>

</html>