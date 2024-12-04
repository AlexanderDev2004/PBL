document.addEventListener('DOMContentLoaded', function() {
    const nimInput = document.getElementById('nim');
    const namaMahasiswaField = document.getElementById('nama_mahasiswa');
    const namaProdiField = document.getElementById('nama_prodi');
    const angkatanField = document.getElementById('angkatan');
    const namaKelasField = document.getElementById('nama_kelas');

    nimInput.addEventListener('input', function() {
        if (this.value.length === 10) { // Sesuaikan dengan panjang NIM
            fetch(BASEURL + '/dosen/getMahasiswaByNIM', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'nim=' + this.value
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    namaMahasiswaField.value = data.data.nama;
                    namaProdiField.value = data.data.nama_prodi;
                    angkatanField.value = data.data.angkatan;
                    namaKelasField.value = data.data.nama_kelas;
                } else {
                    namaMahasiswaField.value = '';
                    namaProdiField.value = '';
                    angkatanField.value = '';
                    namaKelasField.value = '';
                    alert('Data mahasiswa tidak ditemukan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
}); 