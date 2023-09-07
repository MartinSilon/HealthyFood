<?php
require 'head.php';
require 'database_login/conn.php';

// --->     Validacia VSTUPNÝCH DÁT     <---
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['pass'])) {
    $password = validate($_POST['pass']);
    $email = validate($_POST['email']);
    $_SESSION['email'] = $email;

    if (empty($_POST['pass']) || empty($_POST['email'])) {
        header("Location: page_login.php?error=Nevyplnili ste jedno z polí. &email=$email");    //Ak je jedno z polí nevyplnené
        exit();
    }
    // --->     HESLO validacia     <---
    $sql = "SELECT password FROM uzivatelia WHERE email = ? LIMIT 1";
    $stmp = $conn->prepare($sql);
    $stmp->bind_param("s", $email);
    $stmp->execute();
    $stmp->bind_result($ziskanyPass);
    if ($stmp->fetch()) {   //Ak sa Email v DB nájde
        $dbPass = $ziskanyPass;
        $stmp->close();
    } else {
        header("Location: page_login.php?error=Tento email ešte nemá svoje konto. &email=$email");  //Ak sa Email v DB nenašiel
        exit();
    }
    if ($password != $dbPass) {
        header("Location: page_login.php?error=Zlé zadané heslo alebo email. &email=$email");   //Ak je zlé zadané HESLO
        exit();
    }
    header("Location: index.php?email=$email"); //Presmerovanie na vlastné konto
    exit();
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
                    <label class="white text-uppercase fw-bold " for="pass">Email:</label><br>
                    <input class=" w-100 py-sm-5 py-lg-2 fs-1" type="email" id="email" name="email"
                           value=<?php if (isset($_GET['email'])) {
                        echo $_GET['email'];
                    } ?>><br>

                    <label class="white text-uppercase fw-bold " for="pass">Password:</label><br>
                    <input class=" w-100 py-sm-5 py-lg-2 fs-1" type="password" id="pass" name="pass"><br>

                    <input class="w-100 mt-sm-5 mt-lg-2 py-sm-5 py-lg-2 fs-1 fw-bold text-uppercase submit"
                           type="submit" value="Vojsť dnu">
                </form>
            </div>
        </div>
        <a href="page_register.php">
            <div class="w-100">
                REGISTROVAT SA
            </div>
        </a>
    </div>
</section>
</body>
</html>

