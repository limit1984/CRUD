<?php

session_start(); //啟用 session

unset($_SESSION['user']);

header('Location: basepage.php');