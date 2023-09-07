<?php
require 'head.php';
require 'database_login/conn.php';

$meno = "";
$email = "";
$pass = "";
$birth = $datum;

// --->     Validacia VSTUPNÝCH DÁT     <---
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['meno']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['birth'])) {
    $meno = validate($_POST['meno']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);
    $birth = validate($_POST['birth']);

    if (empty($_POST['meno']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['birth'])) {
        if (empty($_POST['meno'])) {
            $error = "Meno je povinné pole";
        } elseif (empty($_POST['email'])) {
            $error = "Vyplnte prosím email";
        } elseif (empty($_POST['pass'])) {
            $error = "Zjavne ste zabudli na heslo";
        }
        header("Location: page_register.php?error=$error. &meno=$meno &email=$email &datum=$birth");
        exit();
    }
    // --->     EMAIL validacia     <---
    $sql = "SELECT email FROM uzivatelia WHERE email = '$email'";
    $stmp = $conn->prepare($sql);
    $stmp->execute();
    $stmp->bind_result($ziskanyEmail);

    if ($stmp->fetch()) {
        header("Location: page_register.php?error=Email uz je registrovany. &meno=$meno &email=$email &datum=$birth");
        exit();
    }
    $stmp->close();

    // --->     DÁTUM validacia     <---
    $dateValidate = (date("Y") - 13) . date("-m-d");    //13 rokov a viac
    if ($birth > $dateValidate) {
        header("Location: page_register.php?error=Na registráciu musíš mať viac ako 13 rokov. &meno=$meno &email=$email &datum=$birth");
        exit();
    }
    // --->     HESLO validacia     <---
    $lowercase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    if (!$lowercase || !$number || strlen($pass) < 6) {
        header("Location: page_register.php?error=Heslo nie je dostatočné silné, použite kombináciu čísel a písmen s dlžkou viac ako 6 znakov. &meno=$meno &email=$email &datum=$birth");
        exit();
    }

    // --->     ZAPÍSANIE DO DB     <---
    $sql = "INSERT INTO uzivatelia (meno, email, password, birth) VALUES (?, ?, ?, ?);";
    $stmp = $conn->prepare($sql);
    $stmp->bind_param("ssss", $meno, $email, $pass, $birth);

    if ($stmp->execute()) {
        header("Location: page_login.php");
        $stmp->close();
    } else {
        echo 'query error' . mysqli_error($conn);
    }


}
?>
<body>
<section class="pass d-flex justify-content-center align-items-center h-100 w-100">
    <div class="container mw-100">
        <div class="row">
            <div class="col-12 text-center">
                <form method="POST">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error fs-5"><?php echo htmlspecialchars($_GET['error']); ?></p>
                    <?php } ?>
                    <label class="white text-uppercase fw-bold " for="pass">Tvoja prezývka:</label><br>
                    <input class=" w-100 py-sm-5 py-lg-2 fs-1" type="text" id="meno" name="meno"
                           value="<?php if (isset($_GET['meno'])) {
                               echo(($_GET['meno']));
                           } ?>"><br>

                    <label class="white text-uppercase fw-bold " for="pass">Email:</label><br>
                    <input class=" w-100 py-sm-5 py-lg-2 fs-1" type="email" id="email" name="email"
                           value="<?php if (isset($_GET['email'])) {
                               echo(($_GET['email']));
                           } ?>"><br>

                    <label class="white text-uppercase fw-bold " for="pass">Heslo:</label><br>
                    <input class=" w-100 py-sm-5 py-lg-2 fs-1" type="password" id="pass" name="pass"><br>

                    <label class="white text-uppercase fw-bold " for="pass">Dátum narodenia:</label><br>
                    <input class=" w-100 py-sm-5 py-lg-2 fs-1" type="date" id="birth" name="birth"
                           value="<?php if (isset($_GET['datum'])) {
                               echo $_GET['datum'];
                           } else {
                               echo($datum);
                           } ?>"><br>

                    <input class="w-100 mt-sm-5 mt-lg-2 py-sm-5 py-lg-2 fs-1 fw-bold text-uppercase submit"
                           type="submit" value="Vojsť dnu">
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>


