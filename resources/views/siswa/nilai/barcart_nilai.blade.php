<script>
    let currentChart = null;

    function buatGrafikBatang() {
        destroyChart();
        const ctx = document.getElementById('myChart').getContext('2d');

        const labels = {!! json_encode($labels) !!};
        const data = {!! json_encode($data) !!};

        currentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai',
                    data: data,
                    backgroundColor: [
                        '#87ceeb',
                        '#4fc3f7',
                        '#42a5f5',
                        '#2196f3',
                        '#1976d2',
                        '#1565c0',
                    ],
                    borderWidth: 2,
                    borderRadius: 10
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
                        text: 'Nilai dari pertemuan terbaru',
                        font: {
                            size: 22,
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


    function createGradient(ctx) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(33, 150, 243, 0.7)');
        gradient.addColorStop(0.5, 'rgba(100, 181, 246, 0.5)');
        gradient.addColorStop(1, 'rgba(227, 242, 253, 0.3)');
        return gradient;
    }

    function buatGrafikGaris() {
        destroyChart();
        const ctx = document.getElementById('myChart').getContext('2d');

        const labels = {!! json_encode($labels) !!};
        const data = {!! json_encode($data) !!};

        currentChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai',
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
                        text: 'Nilai dari pertemuan terbaru',
                        font: {
                            size: 22,
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



    function destroyChart() {
        if (currentChart) {
            currentChart.destroy();
            currentChart = null;
        }
    }

    function switchChart(type) {
        switch (type) {
            case 'bar':
                buatGrafikBatang();
                break;
            case 'line':
                buatGrafikGaris();
                break;
        }
    }

    // Inisialisasi chart pertama kali
    document.addEventListener('DOMContentLoaded', function() {
        buatGrafikBatang();
    });
</script>
