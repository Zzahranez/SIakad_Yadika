<script>
    const ctx = document.getElementById('grafikNilai').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                    label: 'Total pertemuan kelas',
                    data: {!! json_encode($total_kehadiran ?? []) !!}, // data untuk line chart
                    backgroundColor: [
                        '#87ceeb',
                        '#4fc3f7',
                        '#42a5f5',
                        '#2196f3',
                        '#1976d2',
                        '#1565c0',
                    ],
                    borderRadius: 10,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    type: 'line', // dataset ini pakai line chart
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#2d65b2',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                },
                {
                    label: 'Rata-rata Nilai Per Mapel',
                    data: {!! json_encode($data) !!},
                    backgroundColor: [
                        '#003f5c',
                        '#2f4b7c',
                        '#665191',
                        '#a05195',
                        '#d45087',
                        '#f95d6a',
                        '#ff7c43',
                        '#ffa600',
                        '#1f77b4',
                        '#17becf'
                    ],
                    borderWidth: 2,
                    borderRadius: 10,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    type: 'bar',
                    yAxisID: 'y',
                }
            ]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1500
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Rata-rata nilai permapel',
                    font: {
                        size: 18,
                        weight: 'bold'
                    },
                    color: '#2d65b2'
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
</script>
