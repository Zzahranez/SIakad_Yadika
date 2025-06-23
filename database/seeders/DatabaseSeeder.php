<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Makanan;
use App\Models\Mapel;
use App\Models\Pembelajaran;
use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // |========================================|
        // |======= DIBAWAH INI SEEDER MAPEL =======|
        // |========================================|

        // Mata Pelajaran
        $nama_mata_pelajaran = ['Matematika', 'Biologi', 'Fisika', 'Kimia', 'Sejarah', 'PPKN', 'Penjas'];


        for ($i = 0; $i < count($nama_mata_pelajaran); $i++) {
            Mapel::create([
                'nama_mapel' => $nama_mata_pelajaran[$i],
            ]);
        }

        // |========================================|
        // |======= DIBAWAH INI SEEDER KELAS =======|
        // |========================================|


        $nama_kelas = ['10 A', '10 B', '11 A', '11 B', '12 A', '12 B'];

        foreach ($nama_kelas as $nk) {
            Kelas::firstOrCreate([
                'nama_kelas' => $nk
            ]);
        }



        // |========================================|
        // |======= DIBAWAH INI SEEDER USERS =======|
        // |========================================|

        // Loop untuk membuat 20 data siswa dan user
        $kelas11 = Kelas::whereIn('nama_kelas', ['11 A', '11 B'])->get()->keyBy('nama_kelas');

        $kelas_siswa = [
            '11 A' => 0,
            '11 B' => 0
        ];

        for ($i = 1; $i <= 20; $i++) {
            do {
                $selected_kelas = array_rand($kelas_siswa);
            } while ($kelas_siswa[$selected_kelas] >= 10);

            $kelas_siswa[$selected_kelas]++;

            $siswa = Siswa::create([
                'nama' => 'Siswa ' . $i,
                'nis_nisn' => rand(100000, 999999) . '/' . rand(100000000, 999999999),
                'tanggal_lahir' => '2005-' . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT),
                'jenis_kelamin' => $i % 2 == 0 ? 'laki-laki' : 'perempuan',
                'kelas_id' => $kelas11[$selected_kelas]->id,
                'alamat' => 'Alamat Siswa ' . $i,
                'no_telp' => '08' . rand(1000000000, 9999999999),
                'tahun_masuk' => rand(2018, 2022),
            ]);

            User::create([
                'email' => 'siswa' . $i . '@gmail.com',
                'password' => Hash::make('password' . $i),
                'role' => 'siswa',
                'userable_type' => Siswa::class,
                'userable_id' => $siswa->id,
            ]);
        }


        // $siswa = Siswa::create([
        //     'nama' => 'Budi Siswa',
        //     'nis_nisn' => '123456/109238912',
        //     'tanggal_lahir' => '2005-05-10',
        //     'jenis_kelamin' => 'laki-laki',
        //     'kelas_id' => $kelas->id,
        //     'alamat' => 'Pattimura',
        //     'no_telp' => '097540302121',
        //     'tahun_masuk' => '2019',
        // ]);

        // User::create([
        //     'email' => 'test@gmail.com',
        //     'password' => Hash::make('admin123321'),
        //     'role' => 'siswa',
        //     'userable_type' => Siswa::class,
        //     'userable_id' => $siswa->id,
        // ]);


        $guru = Guru::create([
            'nama' => 'Ani',
            'nip' => '1987654321',
            'alamat' => 'Kobar boss',
            'jenis_kelamin' => 'perempuan',
            'no_telp' => '081234567890',
            'tanggal_lahir' => '1985-05-14',
            'status_kepegawaian' => 'tetap',
            'pendidikan_terakhir' => 'S1',
            'jurusan' => 'Pendidikan Matematika',
            'tahun_masuk' => 2010,
        ]);

        User::create([
            'email' => 'gurutest@gmail.com',
            'password' => Hash::make('admin123321'),
            'role' => 'guru',
            'userable_type' => Guru::class,
            'userable_id' => $guru->id,
        ]);
        //Guru dua
        $guru = Guru::create([
            'nama' => 'Dono',
            'nip' => '18302137014214',
            'alamat' => 'Pattimura',
            'jenis_kelamin' => 'laki-laki',
            'no_telp' => '081275664432',
            'tanggal_lahir' => '1999-05-14',
            'status_kepegawaian' => 'tetap',
            'pendidikan_terakhir' => 'S1',
            'jurusan' => 'Pendidikan Kimia',
            'tahun_masuk' => 2015,
        ]);

        User::create([
            'email' => 'gurutest2@gmail.com',
            'password' => Hash::make('admin123321'),
            'role' => 'guru',
            'userable_type' => Guru::class,
            'userable_id' => $guru->id,
        ]);


        $admin = Admin::create([
            'nama' => 'admin',
            'alamat' => 'Alamat Admin',
            'jenis_kelamin' => 'laki-laki',
            'tanggal_lahir' => '1985-05-14',
            'no_telp' => '087765436654',
            'status' => 'aktif',
        ]);

        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123321'),
            'role' => 'admin',
            'userable_type' => Admin::class,
            'userable_id' => $admin->id
        ]);

        // |=======================================|
        // |=== DIBAWAH INI SEEDER PEMBELAJARAN ===|
        // |=======================================|

        // Pembelajaran::create([
        //     'kelas_id' => Kelas::first()->id,
        //     'mapel_id' => Mapel::first()->id,
        //     'guru_id' => Guru::first()->id,
        // ]);

        //|========================================|
        //|== DIBAWAH INI SEEDER UNTUK PERTEMUAN ==|
        //|========================================|

        // Pertemuan::create([
        //     'pembelajaran_id' => Pembelajaran::first()->id,
        //     'tanggal' => '2025-05-14',
        //     'jam_mulai' => '07:30:00',
        //     'jam_selesai' => '09:30:00',
        //     'materi' => 'Logaritma',
        // ]);
        //|=========================================|
        //|=== DIBAWAH INI SEEDER UNTUK PRESENSI ===|
        //|=========================================|
        // Presensi::create([
        //     'pertemuan_id' => Pertemuan::first()->id,
        //     'siswa_id' => Siswa::first()->id,
        //     'status' => 'hadir'
        // ]);

        //|==============================================================|
        //|=== DIBAWAH INI SEEDER TESTING DENGAN BANYAK DATA PRESENSI ===|
        //|==============================================================|
        $used = [];
        for ($i = 0; $i < 14; $i++) {
            do {
                $kelas_id = rand(3, 4);
                $mapel_id = rand(1, 7);
                $guru_id = rand(1, 2);
                $key = "$guru_id-$kelas_id-$mapel_id";
            } while (in_array($key, $used));

            $used[] = $key;
            $pembelajaran = Pembelajaran::create([
                'kelas_id' => $kelas_id,
                'mapel_id' => $mapel_id,
                'guru_id' => $guru_id,
            ]);
        }


        //|============================================|
        //|=== DIBAWAH INI SEEDER UNTUK API MAKANAN ===|
        //|============================================|

        for ($i = 0; $i < 3; $i++) {
            Makanan::create([
                'nama' => 'makanan' . $i,
                'harga' => rand(10000, 15000),
            ]);
        }
    }
}
