<?php 

function getRolePegawai($IdPegawai) {
    global $conn;

    $sql = "SELECT rp.role_pegawai 
	            FROM pegawai AS p
	            INNER JOIN role_pegawai AS rp ON p.id_role_pegawai = rp.id_role_pegawai
	            WHERE p.id_pegawai = ?";
    $stmt = sqlsrv_prepare($conn, $sql, array($IdPegawai));
    if ($stmt && sqlsrv_execute($stmt)) {
        $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        return $result['role_pegawai'];
    }
}

?>