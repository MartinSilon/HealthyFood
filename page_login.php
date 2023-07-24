<?php
require 'head.php';
?>
<html>
<body>
<section class="pass d-flex justify-content-center align-items-center h-100 w-100">
    <div class="container mw-100">
        <div class="row">
            <div class="col-12 text-center">
                <form method="POST" action="config/conf_login.php">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error fs-5"><?php echo htmlspecialchars($_GET['error']); ?></p>
                    <?php } ?>
                    <label class="white text-uppercase fw-bold " for="pass">Password:</label><br>
                    <input class=" w-100 py-sm-5 py-lg-2 fs-1" type="password" id="pass" name="pass"><br>
                    <input class="w-100 mt-sm-5 mt-lg-2 py-sm-5 py-lg-2 fs-1 fw-bold text-uppercase submit" type="submit" value="Vojsť dnu">
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>

