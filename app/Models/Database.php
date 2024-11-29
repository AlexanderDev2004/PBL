<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'sqlsrv', // Driver untuk SQL Server
    'host'      => '127.0.0.1', // IP atau hostname server database Anda
    'port'      => '1433', // Port default SQL Server (ubah jika berbeda)
    'database'  => 'reg_it_v213', // Nama database
    'username'  => 'LAPTOP-MHVH0S2R', // Username SQL Server
    'password'  => '', // Password SQL Server
    'charset'   => 'utf8', // Karakter encoding
    'collation' => 'utf8_unicode_ci', // Collation
    'prefix'    => '', // Prefiks tabel (biarkan kosong jika tidak ada)
]);

// Set Capsule sebagai global dan boot Eloquent
$capsule->setAsGlobal();
$capsule->bootEloquent();
