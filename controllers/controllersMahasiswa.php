<?php
// controllersMahasiswa.php

session_start();
require '../core/dbconfig.php'; // File koneksi database

include_once '../models/user.php';
include_once '../models/mahasiswa.php';

class controllersMahasiswa
{
    public function index()
    {
        include "views/mahasiswa/index.php";
    }
}
?>