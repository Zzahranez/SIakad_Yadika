<script>
    const ctx = document.getElementById('myPieChart').getContext('2d');
    const labels = {!! json_encode($label_piecart_gender) !!};
    const data = {!! json_encode($data_piecart_gender) !!};
    const myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                ],
                borderColor: '#fff',
                borderWidth: 2,
                hoverOffset: 10,
                cutout: 0, // pie, bukan doughnut
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Jumlah siswa laki-laki dan perempuan',
                    font: {
                        size: 18,
                        weight: 'bold'
                    },

                },
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 15,
                        padding: 15,
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        color: '#444'
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#333',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 8,
                    cornerRadius: 5,
                    callbacks: {
                        label: context => `${context.label}: ${context.parsed}`
                    }
                }
            }
        }
    });
</script>
