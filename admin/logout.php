<?php
unset($_SESSION["email"]);
header("Location: ../?page=menu");
exit();