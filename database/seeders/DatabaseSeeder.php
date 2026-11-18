<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Lahan, Pekerja, HasilPanen, KegiatanOperasional};

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $admin = User::create(['username' => 'admin', 'password' => Hash::make('admin123'),
            'nama' => 'Admin Kebun', 'role' => 'admin']);
        User::create(['username' => 'pengawas', 'password' => Hash::make('pengawas123'),
            'nama' => 'Pengawas Produksi', 'role' => 'pengawas']);

        $lahan  = Lahan::create(['nama_lahan' => 'Blok A1', 'luas' => 25.5, 'user_id' => $admin->id]);
        $lahan2 = Lahan::create(['nama_lahan' => 'Blok B2', 'luas' => 30.0, 'user_id' => $admin->id]);

        $p1 = Pekerja::create(['nama' => 'Budi',  'jabatan' => 'Pemanen',   'telp' => '08123456789']);
        $p2 = Pekerja::create(['nama' => 'Andi',  'jabatan' => 'Mandor',    'telp' => '08123456780']);
        $p3 = Pekerja::create(['nama' => 'Citra', 'jabatan' => 'Perawatan', 'telp' => '08123456781']);

        for ($i = 0; $i < 60; $i++) {
            HasilPanen::create([
                'tanggal'    => now()->subDays(rand(0, 180))->format('Y-m-d'),
                'berat'      => rand(500, 2500),
                'lahan_id'   => [$lahan->id, $lahan2->id][array_rand([0,1])],
                'pekerja_id' => [$p1->id, $p2->id][array_rand([0,1])],
            ]);
        }

        foreach (['Pemupukan','Penyemprotan','Perawatan'] as $j) {
            KegiatanOperasional::create([
                'jenis' => $j, 'tanggal' => now()->subDays(rand(1, 60))->format('Y-m-d'),
                'lahan_id' => $lahan->id, 'pekerja_id' => $p3->id,
            ]);
        }
    }
}