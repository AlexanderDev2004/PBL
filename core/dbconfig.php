<?php
// Database configuration
$databaseHost = 'LAPTOP-MHVH0S2R';
$databaseName = 'reg_it_v213';
$databaseUsername = ''; 
$databasePassword = ''; 

// Create database connection
try {
    $dsn = "sqlsrv:Server=$databaseHost;Database=$databaseName";
    $pdo = new PDO($dsn, $databaseUsername, $databasePassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // // Query to fetch data
    // $query = "SELECT * FROM pegawai";  
    // $stmt = $pdo->prepare($query);
    // $stmt->execute();
    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // // Display the result for testing purposes
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
