<form method="POST" action="/dosen/formTambah" enctype="multipart/form-data">
    <label for="nim">NIM:</label>
    <input type="text" name="nim" id="nim" required>
    <button type="button" onclick="cekNIM()">Cek NIM</button>
    <div id="hasilCekNIM"></div>
    
    <label for="tanggal">Tanggal Pelaporan:</label>
    <input type="date" name="tanggal" id="tanggal" required>
    
    <label for="pelanggaran">Pelanggaran:</label>
    <textarea name="pelanggaran" required></textarea>
    
    <label for="bukti">Upload Bukti:</label>
    <input type="file" name="bukti" id="bukti" accept="image/*">
    
    <button type="submit">Simpan</button>
</form>
<script>
    function cekNIM() {
        const nim = document.getElementById('nim').value;
        fetch('/dosen/cekNIM', {
            method: 'POST',
            body: new URLSearchParams({ nim })
        })
        .then(response => response.json())
        .then(data => {
            const hasil = data === '-' ? 'NIM tidak ditemukan' : `Nama: ${data.Nama}, Prodi: ${data.Prodi}, Angkatan: ${data.Angkatan}, Kelas: ${data.Kelas}`;
            document.getElementById('hasilCekNIM').innerText = hasil;
        });
    }
</script>
