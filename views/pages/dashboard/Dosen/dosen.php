<div class="container">
    <h1 class="mb-4">Analisis Data Pelanggaran</h1>
    
    <div class="card">
        <div class="card-body">
            <canvas id="pelanggaranChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('pelanggaranChart').getContext('2d');
const pelanggaranChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Agustus', 'September', 'October', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli'],
        datasets: [{
            label: 'Jumlah Pelanggaran',
            data: [22, 30, 45, 25, 15, 22, 15, 30, 8, 3, 5, 3],
            backgroundColor: 'rgba(135, 206, 250, 0.6)',
            borderColor: 'rgba(135, 206, 250, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    drawBorder: false
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>
