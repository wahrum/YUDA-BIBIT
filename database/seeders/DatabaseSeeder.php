<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::updateOrCreate(
            ['email' => 'admin@yudabibit.com'],
            [
                'name'     => 'Admin Yuda Bibit',
                'email'    => 'admin@yudabibit.com',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // Kategori awal
        $categories = [
            ['name' => 'Tanaman Hias',  'description' => 'Berbagai jenis tanaman hias untuk mempercantik rumah dan taman.'],
            ['name' => 'Tanaman Buah',  'description' => 'Bibit tanaman buah-buahan berkualitas tinggi.'],
            ['name' => 'Tanaman Kayu',  'description' => 'Bibit pohon kayu keras dan bernilai ekonomi tinggi.'],
            ['name' => 'Tanaman Obat',  'description' => 'Tanaman herbal dan obat tradisional.'],
            ['name' => 'Rumput & Penutup Tanah', 'description' => 'Berbagai jenis rumput dan tanaman penutup tanah.'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['name' => $cat['name']],
                $cat
            );
        }

        // Pengaturan situs
        $settings = [
            'site_name'        => 'Yuda Bibit',
            'site_tagline'     => 'Solusi Hijau untuk Taman Impian Anda',
            'site_description' => 'Menyediakan berbagai jenis tanaman hias, bibit buah, dan pohon kayu berkualitas tinggi. Kami berkomitmen menghadirkan tanaman terbaik untuk mempercantik lingkungan Anda.',
            'site_address'     => 'Jl. Contoh No. 1, Kota Anda',
            'site_phone'       => '081234567890',
            'site_whatsapp'    => '6281234567890',
            'site_email'       => 'info@yudabibit.com',
            'site_instagram'   => 'yudabibit',
            'site_facebook'    => 'yudabibit',
            'whatsapp_message' => 'Halo Yuda Bibit, saya ingin bertanya mengenai produk tanaman.',
            'hero_title'       => 'Temukan Tanaman Impian Anda',
            'hero_subtitle'    => 'Koleksi tanaman hias & bibit berkualitas untuk rumah dan taman Anda',
            'about_title'      => 'Tentang Yuda Bibit',
            'about_content'    => 'Yuda Bibit adalah usaha yang bergerak di bidang penjualan tanaman hias, bibit buah, dan pohon kayu. Dengan pengalaman bertahun-tahun, kami siap memberikan tanaman terbaik untuk Anda.',
        ];

        SiteSetting::setMany($settings);

        // Seed produk contoh
        $this->call(ProductSeeder::class);
    }
}
