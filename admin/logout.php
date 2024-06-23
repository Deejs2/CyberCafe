<?php
unset($_SESSION["email"]);
header("Location: ../auth/auth.php?page=auth");
exit();