<script>
    function createGradient(ctx) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(33, 150, 243, 0.7)');
        gradient.addColorStop(0.5, 'rgba(100, 181, 246, 0.5)');
        gradient.addColorStop(1, 'rgba(227, 242, 253, 0.3)');
        return gradient;
    }

    function buatGrafikGaris() {
        const ctx = document.getElementById('myChart').getContext('2d');

        const labels = {!! json_encode($labels_line) !!};
        const data = {!! json_encode($data_line) !!};

        // const labels = Array.from({
        //     length: 120
        // }, (_, i) => `Pertemuan ${i + 1}`);

        // const data = Array.from({
        //     length: 120
        // }, () => Math.floor(Math.random() * 101));
        currentChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai Rata-Rata',
                    data: data,
                    borderColor: '#2196f3',
                    backgroundColor: createGradient(ctx), // Fungsi untuk membuat gradient
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#2196f3',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 1500
                },
                plugins: {
                    title: {
                        display: true,
                        text: [
                            'Distribusi Rata-Rata Nilai Pertemuan',
                            'Keseluruan Pada Setiap Pertemuan'
                        ],
                        font: {
                            size: 18,
                            weight: 'bold'
                        },
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nilai'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Pertemuan'
                        }
                    }
                }
            }
        });
    }

    buatGrafikGaris();
</script>
