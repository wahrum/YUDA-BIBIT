<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // ── Tanaman Hias ──────────────────────────────────────────────────
            [
                'category' => 'Tanaman Hias',
                'name'     => 'Bonsai Beringin',
                'short'    => 'Bonsai beringin mini siap pajang, bentuk sudah terbentuk indah.',
                'desc'     => 'Bonsai beringin dengan usia tanam 3-5 tahun. Bentuk sudah terbentuk rapi dan siap untuk dipajang di dalam maupun luar ruangan. Perawatan mudah, cukup siram 2x sehari.',
                'price'    => 250000,
                'unit'     => 'pohon',
                'featured' => true,
            ],
            [
                'category' => 'Tanaman Hias',
                'name'     => 'Monstera Deliciosa',
                'short'    => 'Tanaman hias daun besar khas dengan lubang unik, cocok untuk interior.',
                'desc'     => 'Monstera Deliciosa atau Swiss Cheese Plant adalah tanaman hias populer dengan daun berlubang yang unik. Cocok untuk dekorasi interior rumah dan kantor. Tahan di tempat teduh.',
                'price'    => 85000,
                'unit'     => 'pohon',
                'featured' => true,
            ],
            [
                'category' => 'Tanaman Hias',
                'name'     => 'Aglonema Merah',
                'short'    => 'Aglonema warna merah merona, tanaman hias indoor favorit.',
                'desc'     => 'Aglonema Red merupakan salah satu tanaman hias paling populer. Warna merahnya yang mencolok menjadi daya tarik tersendiri. Sangat cocok untuk dalam ruangan, tidak memerlukan sinar matahari langsung.',
                'price'    => 65000,
                'unit'     => 'pohon',
                'featured' => true,
            ],
            [
                'category' => 'Tanaman Hias',
                'name'     => 'Sansevieria / Lidah Mertua',
                'short'    => 'Tanaman hias pembersih udara, sangat mudah dirawat.',
                'desc'     => 'Sansevieria atau Lidah Mertua dikenal sebagai tanaman pembersih udara terbaik. Tahan kekeringan, cocok untuk pemula. Bisa diletakkan di dalam maupun luar ruangan.',
                'price'    => 35000,
                'unit'     => 'pohon',
                'featured' => false,
            ],
            [
                'category' => 'Tanaman Hias',
                'name'     => 'Palem Kuning',
                'short'    => 'Palem kuning cantik untuk taman dan interior ruangan.',
                'desc'     => 'Palem Kuning atau Chrysalidocarpus lutescens adalah tanaman hias yang elegan. Cocok untuk taman tropis maupun sebagai tanaman indoor. Pertumbuhan lambat dan mudah dirawat.',
                'price'    => 120000,
                'unit'     => 'pohon',
                'featured' => false,
            ],

            // ── Tanaman Buah ──────────────────────────────────────────────────
            [
                'category' => 'Tanaman Buah',
                'name'     => 'Bibit Mangga Harum Manis',
                'short'    => 'Bibit mangga harum manis okulasi, cepat berbuah.',
                'desc'     => 'Bibit mangga harum manis hasil okulasi dari pohon induk unggul. Lebih cepat berbuah dibanding biji, biasanya mulai berbuah di tahun ke 2-3. Buah manis legit dengan aroma harum.',
                'price'    => 45000,
                'unit'     => 'pohon',
                'featured' => true,
            ],
            [
                'category' => 'Tanaman Buah',
                'name'     => 'Bibit Jambu Kristal',
                'short'    => 'Bibit jambu kristal tanpa biji, manis dan renyah.',
                'desc'     => 'Jambu Kristal adalah varietas jambu biji yang hampir tidak berbiji. Daging buahnya tebal, manis, dan renyah. Cocok ditanam di pot maupun di tanah langsung.',
                'price'    => 55000,
                'unit'     => 'pohon',
                'featured' => false,
            ],
            [
                'category' => 'Tanaman Buah',
                'name'     => 'Bibit Alpukat Mentega',
                'short'    => 'Bibit alpukat mentega unggul, daging tebal dan creamy.',
                'desc'     => 'Alpukat Mentega atau Alpukat Aligator merupakan varietas unggulan dengan daging buah tebal, sedikit serat, dan rasa creamy. Hasil okulasi, mulai berbuah di tahun ke 2-3.',
                'price'    => 75000,
                'unit'     => 'pohon',
                'featured' => true,
            ],
            [
                'category' => 'Tanaman Buah',
                'name'     => 'Bibit Jeruk Siam',
                'short'    => 'Bibit jeruk siam manis, cocok untuk pot maupun lahan.',
                'desc'     => 'Jeruk Siam adalah varietas jeruk yang populer di Indonesia. Rasanya manis segar, kulit tipis, dan banyak air. Bisa ditanam dalam pot (tabulampot) maupun di lahan terbuka.',
                'price'    => 40000,
                'unit'     => 'pohon',
                'featured' => false,
            ],

            // ── Tanaman Kayu ──────────────────────────────────────────────────
            [
                'category' => 'Tanaman Kayu',
                'name'     => 'Bibit Jati Unggul',
                'short'    => 'Bibit jati super unggul, pertumbuhan cepat dan kayu keras.',
                'desc'     => 'Bibit pohon Jati Super hasil kultur jaringan. Pertumbuhan lebih cepat dari jati biasa, kayu keras dan berkualitas tinggi. Cocok untuk investasi jangka panjang.',
                'price'    => 25000,
                'unit'     => 'batang',
                'featured' => true,
            ],
            [
                'category' => 'Tanaman Kayu',
                'name'     => 'Bibit Sengon Laut',
                'short'    => 'Bibit sengon laut cepat tumbuh, nilai ekonomi tinggi.',
                'desc'     => 'Pohon Sengon Laut (Albizia falcataria) adalah tanaman kayu yang paling cepat tumbuh. Dalam 5-7 tahun sudah bisa dipanen. Kayu ringan dan banyak digunakan untuk industri.',
                'price'    => 10000,
                'unit'     => 'batang',
                'featured' => false,
            ],
            [
                'category' => 'Tanaman Kayu',
                'name'     => 'Bibit Mahoni',
                'short'    => 'Bibit mahoni untuk penghijauan dan investasi kayu.',
                'desc'     => 'Mahoni adalah pohon kayu keras dengan nilai ekonomi tinggi. Selain untuk kayu, mahoni juga berfungsi sebagai pohon peneduh dan penyerap polusi. Cocok untuk program penghijauan.',
                'price'    => 15000,
                'unit'     => 'batang',
                'featured' => false,
            ],

            // ── Tanaman Obat ──────────────────────────────────────────────────
            [
                'category' => 'Tanaman Obat',
                'name'     => 'Jahe Merah',
                'short'    => 'Bibit jahe merah organik, khasiat tinggi untuk kesehatan.',
                'desc'     => 'Jahe Merah dikenal memiliki kandungan gingerol lebih tinggi dari jahe biasa. Berkhasiat untuk meningkatkan imun tubuh, menghangatkan badan, dan mengatasi masuk angin. Mudah ditanam di pot.',
                'price'    => 15000,
                'unit'     => 'rumpun',
                'featured' => false,
            ],
            [
                'category' => 'Tanaman Obat',
                'name'     => 'Lidah Buaya / Aloe Vera',
                'short'    => 'Tanaman lidah buaya multifungsi, untuk obat dan kecantikan.',
                'desc'     => 'Lidah Buaya atau Aloe Vera adalah tanaman obat serbaguna. Gel-nya dapat digunakan untuk mengobati luka bakar, melembapkan kulit, dan menyuburkan rambut. Sangat mudah dirawat.',
                'price'    => 20000,
                'unit'     => 'pohon',
                'featured' => false,
            ],
            [
                'category' => 'Tanaman Obat',
                'name'     => 'Kunyit Putih',
                'short'    => 'Bibit kunyit putih langka, berkhasiat sebagai anti kanker alami.',
                'desc'     => 'Kunyit Putih atau Curcuma zedoaria adalah tanaman obat langka yang dipercaya memiliki khasiat anti kanker, anti inflamasi, dan meningkatkan sistem kekebalan tubuh. Mudah ditanam di pekarangan.',
                'price'    => 25000,
                'unit'     => 'rumpun',
                'featured' => true,
            ],

            // ── Rumput & Penutup Tanah ────────────────────────────────────────
            [
                'category' => 'Rumput & Penutup Tanah',
                'name'     => 'Rumput Gajah Mini',
                'short'    => 'Rumput gajah mini tebal dan hijau, cocok untuk taman.',
                'desc'     => 'Rumput Gajah Mini (Pennisetum purpureum) adalah pilihan terbaik untuk taman rumah. Daunnya halus, warna hijau cerah, dan pertumbuhannya merata. Tahan injak dan mudah perawatannya.',
                'price'    => 20000,
                'unit'     => 'm²',
                'featured' => false,
            ],
            [
                'category' => 'Rumput & Penutup Tanah',
                'name'     => 'Rumput Jepang',
                'short'    => 'Rumput jepang halus dan rapi untuk taman minimalis.',
                'desc'     => 'Rumput Jepang (Zoysia japonica) terkenal dengan teksturnya yang halus dan tampilan yang rapi. Sangat cocok untuk taman bergaya minimalis modern. Tumbuh lambat sehingga jarang dipotong.',
                'price'    => 25000,
                'unit'     => 'm²',
                'featured' => false,
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();

            if (!$category) {
                continue;
            }

            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'category_id'       => $category->id,
                    'name'              => $item['name'],
                    'slug'              => Str::slug($item['name']),
                    'short_description' => $item['short'],
                    'description'       => $item['desc'],
                    'price'             => $item['price'],
                    'unit'              => $item['unit'],
                    'is_active'         => true,
                    'is_featured'       => $item['featured'],
                ]
            );
        }

        $this->command->info('✅ ' . count($products) . ' produk berhasil di-seed.');
    }
}
