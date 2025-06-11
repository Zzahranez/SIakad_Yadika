
function buatGrafikBatang() {
    const ctx = document.getElementById('myChart').getContext('2d');


};

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Nilai',
            data: data,
            backgroundColor: [
                '#36a2eb',
                '#ffce56',
            ],
            borderWidth: 2,
            borderRadius: 10
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 2000
        },
        plugins: {
            title: {
                display: true,
                text: 'Nilai Dari Pertemuan Terbaru'
            }
        }
    }
});


// Buat grafik garis
function buatGrafikGaris() {
    const ctx = document.getElementById('myChart2').getContext('2d');

};


new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Pengunjung',
            data: data,
            borderColor: '#ff6384',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 2000
        },
        plugins: {
            title: {
                display: true,
                text: 'Traffic Harian'
            }
        }
    }
});
        

// Buat grafik donat
function buatGrafikDonat() {
    const ctx = document.getElementById('myChart3').getContext('2d');


};


new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
                '#ff6384',
                '#36a2eb',
                '#ffce56'
            ],
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 2000
        },
        plugins: {
            title: {
                display: true,
                text: 'Platform Pengguna'
            }
        }
    }
});


buatGrafikBatang()


