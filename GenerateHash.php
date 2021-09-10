<?php

if (PHP_SAPI !== "cli") {
  die("Hoje não");
}

$password = "12345678";

echo password_hash($password, PASSWORD_DEFAULT);
