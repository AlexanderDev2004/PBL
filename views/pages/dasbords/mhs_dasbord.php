<!-- Buatkan halaman dasbord mahasiswa -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dasbord Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Cek apakah ada data dalam table mahasiswa
                                if ($stmt->rowCount() > 0) {
                                    // Mengambil semua data dari table mahasiswa
                                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . $data['NIM'] . "</td>";
                                        echo "<td>" . $data['nama_mahasiswa'] . "</td>";
                                        echo "<td>" . $data['status_mahasiswa'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='edit_mhs.php?id=" . $data['id_mahasiswa'] . "' class='btn btn-primary'>Edit</a>";
                                        echo "<a href='delete_mhs.php?id=" . $data['id_mahasiswa'] . "' class='btn btn-danger'>Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Tidak ada data!</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>  
    
<?php
include_once "components/footer.php";
?>