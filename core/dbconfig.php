<?php
// Database configuration
// $databaseHost = 'KHIP01\SQLEXPRESS';
// $databaseName = 'reg_it';
// $databaseUsername = '';
// $databasePassword = '';

// Create database connection
// try {
//     $dsn = "sqlsrv:Server=$databaseHost;Database=$databaseName";
//     $pdo = new PDO($dsn, $databaseUsername, $databasePassword);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // // Query to fetch data
//     // $query = "SELECT * FROM pegawai";  
//     // $stmt = $pdo->prepare($query);
//     // $stmt->execute();
//     // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // // Display the result for testing purposes
//     // echo "<pre>";
//     // print_r($result);
//     // echo "</pre>";

// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// } catch (Exception $e) {
//     die("Error: " . $e->getMessage());
// }

// Connect to SQL Server
$serverName = "LAPTOP-MHVH0S2R"; //serverName\instanceName
$connectionInfo = array("Database" => "reg_it_v213");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    echo "Connection established.<br />";
} else {
    echo "Connection could not be established.<br />";
    die(print_r(sqlsrv_errors(), true));
}