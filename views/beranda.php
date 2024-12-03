<canvas id="chartPelanggaran"></canvas>
<script src="/assets/js/chart.min.js"></script>
<script>
    const data = <?= json_encode($data['chart']); ?>;
    const labels = ['Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli'];
    const jumlahPelanggaran = Array(12).fill(0);
    data.forEach(item => {
        jumlahPelanggaran[item.Bulan - 1] = item.JumlahPelanggaran;
    });

    const ctx = document.getElementById('chartPelanggaran').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah Pelanggaran',
                data: jumlahPelanggaran,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });
</script>
