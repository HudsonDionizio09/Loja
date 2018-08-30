<?php


session_start();
session_destroy();
$home = "/loja/";
header("location: $home");