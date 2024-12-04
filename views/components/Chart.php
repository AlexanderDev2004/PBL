<!-- Graph -->
<div class="mx-auto rounded-md shadow-md p-4 flex-col justify-center items-center max-w-screen-xl bg-white mt-10">
        <div class="">
            <canvas id="myChart" class="mx-auto mb-14 h-[600px] mb-6 flex rounded"></canvas>
        </div>
    </div>    

    <!-- Code Grafik -->
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Jumlah Pelanggaran',
                    data: [12, 19, 3, 5, 2, 3, 7, 8, 9, 10, 11, 12],
                    borderWidth: 1,
                      
                }]
            },
            options: {
                scales: {

                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!-- Code Grafik End -->