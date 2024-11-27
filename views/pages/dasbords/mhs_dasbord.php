<!-- pages uji coba jika berhasil login sebagai mahasiswa setelah memasukan username nim dan password -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM kredensial_mahasiswa ORDER BY id_mahasiswa ASC";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute();

                                    // Debugging query
                                    echo "Query yang dieksekusi: $query<br>";

                                    if ($stmt->rowCount() > 0) {
                                        $i = 0;
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $i++;
                                            echo "<tr>";
                                            echo "<td>$i</td>";
                                            echo "<td>" . $row['nim'] . "</td>";
                                            echo "<td>" . $row['nama'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['role'] . "</td>";
                                            echo "<td>";
                                            echo "<a href='edit.php?id=" . $row['id_mahasiswa'] . "'>Edit</a> | ";
                                            echo "<a href='delete.php?id=" . $row['id_mahasiswa'] . "'>Delete</a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>Tidak ada data!</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    