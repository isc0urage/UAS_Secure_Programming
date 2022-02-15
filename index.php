<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS</title>
    <?php include("./CSRFgenerator.php"); ?>
</head>

<body>
    <form method="post">
        <label for="Fname">First name:</label>
        <input type="text" id="Fname" name="Fname" value="pandy"><br><br>

        <label for="Lname">Last name:</label>
        <input type="text" id="Lname" name="Lname" value="herman"><br><br>

        <label for="Bplace">Birthplace:</label>
        <input type="text" id="Bplace" name="Bplace" value="jakarta"><br><br>

        <label for="Birthday">Birthday:</label>
        <input type="date" id="Birthday" name="Birthday" value="2001-08-16"><br><br>

        <label for="NIK">NIK KTP:</label>
        <input type="text" id="NIK" name="NIK" value="2301866113123456"><br><br>




        <label for="Gender">Gender:</label><br>
        <input type="radio" id="gender1" name="Gender" value="Male">
        <label for="gender1">Male</label><br>

        <input type="radio" id="gender2" name="Gender" value="Female" checked="checked">
        <label for="gender2">Female</label><br><br>

        <label for="Married">Married Status:</label><br>
        <input type="radio" id="married1" name="Married" value="Yes">
        <label for="married1">Yes</label><br>

        <input type="radio" id="married2" name="Married" value="No" checked="checked">
        <label for="married2">No</label><br><br>






        <label for="NPWP">NPWP:</label>
        <input type="text" id="NPWP" name="NPWP" value="09.254.294.3-407.123"><br><br>

        <label for="Kelurahan">Kelurahan:</label>
        <input type="text" id="Kelurahan" name="Kelurahan" value="Jl. Latumenten"><br><br>

        <label for="Kecamatan">Kecamatan:</label>
        <input type="text" id="Kecamatan" name="Kecamatan" value="Grogol Petamburan"><br><br>

        <label for="Kota">Kota:</label>
        <select id="Kota" name="Kota">
            <option value="Jakarta">Jakarta</option>
            <option value="Bogor">Bogor</option>
            <option value="Yogyakarta">Yogyakarta</option>
        </select><br><br>

        <label for="Propinsi">Propinsi:</label>
        <select id="Propinsi" name="Propinsi">
            <option value="Aceh">Aceh</option>
            <option value="Sumatra Utara">Sumatra Utara</option>
            <option value="Sumatra Barat">Sumatra Barat</option>
        </select><br><br>

        <label for="Salary">1 Year Salary:</label>
        <input type="text" id="Salary" name="Salary" value="72000000"><br><br>
        <input type="hidden" name="token" value="<?= csrf_token(); ?>">
        <input type="submit" value="Submit">

    </form>

    <?php if ($_POST) {
        $gagal = 0;
        foreach ($_POST as $key => $value) {
            echo $key . " : " . $value . "<br>";
        }

        //validation starts here//
        if ($_POST["Fname"] == "" || strlen($_POST["Fname"]) > 50) {
            $gagal++;
        }
        if ($_POST["Lname"] == "" || strlen($_POST["Lname"]) > 50) $gagal++;
        if ($_POST["Bplace"] == "" || strlen($_POST["Bplace"]) > 50) $gagal++;
        if ($_POST["Birthday"] == "") $gagal++;
        $birthDate = $_POST["Birthday"];
        $birthDate = explode("-", $birthDate);
        //get age from date or birthdate//
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
            ? ((date("Y") - $birthDate[0]) - 1)
            : (date("Y") - $birthDate[0]));
        if ($age < 18) $gagal++;

        $re = '/[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/';
        $str = $_POST["NIK"];
        if (preg_match($re, $str) != 1) $gagal++;

        if ($_POST["Gender"] == "") $gagal++;
        if ($_POST["Married"] == "") $gagal++;

        $re = '/[0-9][0-9].[0-9][0-9][0-9].[0-9][0-9][0-9].[0-9]-[0-9][0-9][0-9].[0-9][0-9][0-9]/';
        $str = $_POST["NPWP"];
        if (preg_match($re, $str) != 1) $gagal++;

        if ($_POST["Kelurahan"] == "" || strlen($_POST["Kelurahan"]) > 50) $gagal++;
        if ($_POST["Kecamatan"] == "" || strlen($_POST["Kecamatan"]) > 50) $gagal++;
        if ($_POST["Kota"] == "") $gagal++;
        if ($_POST["Propinsi"] == "") $gagal++;

        if (is_numeric($_POST["Salary"])) {
            $t = (int)$_POST["Salary"];
            if ($t < 54000000 || $t > 50000000000)  $gagal++;
        } else $gagal++;
        //valiation ends here//
        if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token']) {
            #aman, lanjutkan seperti biasa.
            //1.3 PPh Calculation//
            $Pph = (int)$_POST["Salary"] - 54000000;
            $Tax = 0;
            if ($Pph > 500000000) {
                $Tax = 30;
            } else if ($Pph > 250000000) {
                $Tax = 25;
            } else if ($Pph > 50000000) {
                $Tax = 15;
            } else {
                $Tax = 5;
            }
            $Final = $Pph * $Tax / 100;
            $_POST["Pph"] = $Final;
            echo "<br>";
            if ($gagal == 0) echo "boleh lanjut mas<br><br>";
            else echo "salah bang" . $gagal . "<br>";
            var_dump($_POST);
            //connect ke database 
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
            //Mysqli_Real_Escape_String Function
            $Fname = mysqli_real_escape_string($conn, $_POST["Fname"]);
            $Lname = mysqli_real_escape_string($conn, $_POST["Lname"]);
            $Bplace =  mysqli_real_escape_string($conn, $_POST["Bplace"]);
            $Birthday =  mysqli_real_escape_string($conn, $_POST["Birthday"]);
            $NIK =  mysqli_real_escape_string($conn, $_POST["NIK"]);
            $Gender =  mysqli_real_escape_string($conn, $_POST["Gender"]);
            $Married =  mysqli_real_escape_string($conn, $_POST["Married"]);
            $NPWP =  mysqli_real_escape_string($conn, $_POST["NPWP"]);
            $Kelurahan =  mysqli_real_escape_string($conn, $_POST["Kelurahan"]);
            $Kecamatan =  mysqli_real_escape_string($conn, $_POST["Kecamatan"]);
            $Kota =  mysqli_real_escape_string($conn, $_POST["Kota"]);
            $Propinsi =  mysqli_real_escape_string($conn, $_POST["Propinsi"]);
            $Salary =  mysqli_real_escape_string($conn, $_POST["Salary"]);
            $Pph =  mysqli_real_escape_string($conn, $_POST["Pph"]);
            //PDO PHP
            $statement = $conn->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->bind_param("sssssssssssssi", $Fname, $Lname, $Bplace, $Birthday, $NIK, $Gender, $Married, $NPWP, $Kelurahan, $Kecamatan, $Kota, $Propinsi, $Salary, $Pph);
            $statement->execute();
            $conn->close();
        } else {
            session_destroy();
        }
    } ?>


</body>

</html>