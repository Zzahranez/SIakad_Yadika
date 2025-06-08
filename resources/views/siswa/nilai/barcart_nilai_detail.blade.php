<script>
    function buatGrafikBatang() {
        const ctx = document.getElementById('myChart').getContext('2d');
        const nama = {!! json_encode($nama) !!};
        const nilai = {!! json_encode($nilai) !!};
        const mapel = {!! json_encode($mapel) !!};
        const materi = {!! json_encode($materi) !!};
        const kelas = {!! json_encode($kelas) !!};
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nama,
                datasets: [{
                    label: 'Nilai',
                    data: nilai,
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
                        text: [
                            `Nilai siswa  Kelas ${kelas}`,
                            `Mata pelajaran ${mapel} Materi ${materi}`
                        ],
                        font: {
                            size: 22,
                        }
                    }
                }
            }
        });
    }
    buatGrafikBatang()
</script>
