<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users (10 users)
        $users = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Citra Dewi',
                'email' => 'citra@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Doni Kusuma',
                'email' => 'doni@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Endang Widayati',
                'email' => 'endang@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Farhan Maulana',
                'email' => 'farhan@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Gita Safitri',
                'email' => 'gita@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Hendra Wijaya',
                'email' => 'hendra@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Indah Permata',
                'email' => 'indah@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Joko Prasetyo',
                'email' => 'joko@example.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Seed Institutions (15 institusi di Jakarta) menggunakan raw SQL
        $institutions = [
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Rumah Perlindungan Bhakti Kasih',
                'street' => 'Jalan Gereja Tugu Kelurahan Semper Barat, Kecamatan Koja',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Utara',
                'district' => 'Koja',
                'village' => 'Semper Barat',
                'city' => 'Jakarta Utara',
                'country' => 'Indonesia',
                'phone_number' => '02145678901',
                'type' => 'Orang Terlantar',
                'longitude' => 106.9035,
                'latitude' => -6.1305,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Panti Asuhan Kasih Ibu',
                'street' => 'Jalan Sunter Permai Raya No. 12',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Utara',
                'district' => 'Tanjung Priok',
                'village' => 'Sunter Jaya',
                'city' => 'Jakarta Utara',
                'country' => 'Indonesia',
                'phone_number' => '02168901234',
                'type' => 'Panti Asuhan',
                'longitude' => 106.8677,
                'latitude' => -6.1421,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Panti Jompo Damai Sejahtera',
                'street' => 'Jalan Kelapa Gading Barat No. 45',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Utara',
                'district' => 'Kelapa Gading',
                'village' => 'Kelapa Gading Barat',
                'city' => 'Jakarta Utara',
                'country' => 'Indonesia',
                'phone_number' => '02145612378',
                'type' => 'Panti Jompo',
                'longitude' => 106.8900,
                'latitude' => -6.1599,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Yayasan Harapan Baru',
                'street' => 'Jalan Pluit Selatan Raya No. 78',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Utara',
                'district' => 'Penjaringan',
                'village' => 'Pluit',
                'city' => 'Jakarta Utara',
                'country' => 'Indonesia',
                'phone_number' => '02166789012',
                'type' => 'Yayasan Sosial',
                'longitude' => 106.7899,
                'latitude' => -6.1290,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Panti Rehabilitasi Cahaya Mentari',
                'street' => 'Jalan Kemayoran Raya No. 120',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Pusat',
                'district' => 'Kemayoran',
                'village' => 'Kemayoran',
                'city' => 'Jakarta Pusat',
                'country' => 'Indonesia',
                'phone_number' => '02142356789',
                'type' => 'Panti Rehabilitasi',
                'longitude' => 106.8414,
                'latitude' => -6.1589,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Rumah Singgah Peduli Anak',
                'street' => 'Jalan Cempaka Putih Tengah No. 55',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Pusat',
                'district' => 'Cempaka Putih',
                'village' => 'Cempaka Putih Tengah',
                'city' => 'Jakarta Pusat',
                'country' => 'Indonesia',
                'phone_number' => '02145678123',
                'type' => 'Rumah Singgah',
                'longitude' => 106.8701,
                'latitude' => -6.1744,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Panti Asuhan Bina Sejahtera',
                'street' => 'Jalan Menteng Raya No. 32',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Pusat',
                'district' => 'Menteng',
                'village' => 'Menteng',
                'city' => 'Jakarta Pusat',
                'country' => 'Indonesia',
                'phone_number' => '02131234567',
                'type' => 'Panti Asuhan',
                'longitude' => 106.8339,
                'latitude' => -6.1968,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Yayasan Cinta Kasih',
                'street' => 'Jalan Tanah Abang III No. 14',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Pusat',
                'district' => 'Tanah Abang',
                'village' => 'Petamburan',
                'city' => 'Jakarta Pusat',
                'country' => 'Indonesia',
                'phone_number' => '02123456789',
                'type' => 'Yayasan Sosial',
                'longitude' => 106.8166,
                'latitude' => -6.1849,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Rumah Perlindungan Anak Terpadu',
                'street' => 'Jalan Pancoran Barat No. 67',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Selatan',
                'district' => 'Pancoran',
                'village' => 'Pancoran Barat',
                'city' => 'Jakarta Selatan',
                'country' => 'Indonesia',
                'phone_number' => '02179123456',
                'type' => 'Rumah Perlindungan',
                'longitude' => 106.8460,
                'latitude' => -6.2460,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Panti Sosial Bina Insan',
                'street' => 'Jalan Kebayoran Baru No. 23',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Selatan',
                'district' => 'Kebayoran Baru',
                'village' => 'Senayan',
                'city' => 'Jakarta Selatan',
                'country' => 'Indonesia',
                'phone_number' => '02172345678',
                'type' => 'Panti Sosial',
                'longitude' => 106.8004,
                'latitude' => -6.2264,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Panti Asuhan Sinar Kasih',
                'street' => 'Jalan Cilandak Raya No. 45',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Selatan',
                'district' => 'Cilandak',
                'village' => 'Cilandak Barat',
                'city' => 'Jakarta Selatan',
                'country' => 'Indonesia',
                'phone_number' => '02175678901',
                'type' => 'Panti Asuhan',
                'longitude' => 106.8230,
                'latitude' => -6.2874,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Panti Jompo Sejahtera',
                'street' => 'Jalan Palmerah Utara No. 76',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Barat',
                'district' => 'Palmerah',
                'village' => 'Palmerah',
                'city' => 'Jakarta Barat',
                'country' => 'Indonesia',
                'phone_number' => '02153456789',
                'type' => 'Panti Jompo',
                'longitude' => 106.7946,
                'latitude' => -6.2017,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Rumah Singgah Bakti Insan',
                'street' => 'Jalan Taman Sari No. 89',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Barat',
                'district' => 'Taman Sari',
                'village' => 'Taman Sari',
                'city' => 'Jakarta Barat',
                'country' => 'Indonesia',
                'phone_number' => '02156789012',
                'type' => 'Rumah Singgah',
                'longitude' => 106.8170,
                'latitude' => -6.1596,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Yayasan Peduli Disabilitas',
                'street' => 'Jalan Cengkareng Raya No. 34',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Barat',
                'district' => 'Cengkareng',
                'village' => 'Cengkareng Timur',
                'city' => 'Jakarta Barat',
                'country' => 'Indonesia',
                'phone_number' => '02158901234',
                'type' => 'Yayasan Sosial',
                'longitude' => 106.7341,
                'latitude' => -6.1472,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Panti Asuhan Cinta Kasih',
                'street' => 'Jalan Duren Sawit Raya No. 55',
                'province' => 'DKI Jakarta',
                'regency' => 'Jakarta Timur',
                'district' => 'Duren Sawit',
                'village' => 'Duren Sawit',
                'city' => 'Jakarta Timur',
                'country' => 'Indonesia',
                'phone_number' => '02186789012',
                'type' => 'Panti Asuhan',
                'longitude' => 106.9137,
                'latitude' => -6.2323,
            ],
        ];

        foreach ($institutions as $institution) {
            $longitude = $institution['longitude'];
            $latitude = $institution['latitude'];
            
            DB::statement("
                INSERT INTO institutions (
                    id, name, street, province, regency, district, village, city, country, 
                    phone_number, type, longitude, latitude, positions, created_at, updated_at
                ) VALUES (
                    '{$institution['id']}', 
                    '{$institution['name']}', 
                    '{$institution['street']}', 
                    '{$institution['province']}', 
                    '{$institution['regency']}', 
                    '{$institution['district']}', 
                    '{$institution['village']}', 
                    '{$institution['city']}', 
                    '{$institution['country']}', 
                    '{$institution['phone_number']}', 
                    '{$institution['type']}', 
                    {$institution['longitude']}, 
                    {$institution['latitude']}, 
                    ST_SetSRID(ST_MakePoint({$longitude}, {$latitude}), 4326),
                    NOW(),
                    NOW()
                )
            ");
        }

        // Seed Items (10 items di Jakarta) menggunakan raw SQL
        $items = [
            [
                'user_id' => 1,
                'category' => 'Pakaian',
                'title' => 'Baju Anak',
                'description' => 'Baju anak umur 5-6 tahun dalam kondisi baik',
                'terms_required' => false,
                'terms_description' => 'Tanpa syarat / untuk didonasikan',
                'image' => 'baju_anak.jpg',
                'longitude' => 106.8463,
                'latitude' => -6.2115,
            ],
            [
                'user_id' => 2,
                'category' => 'Pakaian',
                'title' => 'Kemeja',
                'description' => 'Kemeja lengan panjang motif kotak',
                'terms_required' => true,
                'terms_description' => 'Saya ingin tukar dengan item lain',
                'image' => 'kemeja.jpg',
                'longitude' => 106.8271,
                'latitude' => -6.1751,
            ],
            [
                'user_id' => 3,
                'category' => 'Elektronik',
                'title' => 'Radio Portable',
                'description' => 'Radio portable masih berfungsi dengan baik',
                'terms_required' => false,
                'terms_description' => 'Tanpa syarat / untuk didonasikan',
                'image' => 'radio.jpg',
                'longitude' => 106.7892,
                'latitude' => -6.2241,
            ],
            [
                'user_id' => 4,
                'category' => 'Buku',
                'title' => 'Buku Pelajaran SD',
                'description' => 'Kumpulan buku pelajaran SD kelas 1-6',
                'terms_required' => false,
                'terms_description' => 'Untuk disumbangkan ke sekolah atau panti asuhan',
                'image' => 'buku_sd.jpg',
                'longitude' => 106.9056,
                'latitude' => -6.1912,
            ],
            [
                'user_id' => 5,
                'category' => 'Mainan',
                'title' => 'Boneka Beruang',
                'description' => 'Boneka beruang ukuran sedang masih bagus',
                'terms_required' => true,
                'terms_description' => 'Hanya untuk panti asuhan',
                'image' => 'boneka.jpg',
                'longitude' => 106.8142,
                'latitude' => -6.1760,
            ],
            [
                'user_id' => 6,
                'category' => 'Perabotan',
                'title' => 'Meja Belajar',
                'description' => 'Meja belajar kayu jati ukuran 120x60cm',
                'terms_required' => true,
                'terms_description' => 'Ambil sendiri di lokasi',
                'image' => 'meja.jpg',
                'longitude' => 106.8821,
                'latitude' => -6.2489,
            ],
            [
                'user_id' => 7,
                'category' => 'Alat Dapur',
                'title' => 'Panci Set',
                'description' => 'Set panci stainless steel 3 ukuran',
                'terms_required' => false,
                'terms_description' => 'Untuk disumbangkan',
                'image' => 'panci.jpg',
                'longitude' => 106.7512,
                'latitude' => -6.1587,
            ],
            [
                'user_id' => 8,
                'category' => 'Sepatu',
                'title' => 'Sepatu Sekolah',
                'description' => 'Sepatu sekolah hitam ukuran 38',
                'terms_required' => false,
                'terms_description' => 'Untuk disumbangkan ke anak sekolah yang membutuhkan',
                'image' => 'sepatu.jpg',
                'longitude' => 106.9187,
                'latitude' => -6.2219,
            ],
            [
                'user_id' => 9,
                'category' => 'Tas',
                'title' => 'Tas Sekolah',
                'description' => 'Tas ransel sekolah masih layak pakai',
                'terms_required' => true,
                'terms_description' => 'Khusus untuk panti asuhan',
                'image' => 'tas.jpg',
                'longitude' => 106.7982,
                'latitude' => -6.1387,
            ],
            [
                'user_id' => 10,
                'category' => 'Alat Tulis',
                'title' => 'Set Alat Tulis',
                'description' => 'Set alat tulis lengkap (pensil, pulpen, penghapus, dll)',
                'terms_required' => false,
                'terms_description' => 'Untuk disumbangkan ke sekolah atau panti asuhan',
                'image' => 'alat_tulis.jpg',
                'longitude' => 106.8598,
                'latitude' => -6.3036,
            ],
        ];

        foreach ($items as $item) {
            $longitude = $item['longitude'];
            $latitude = $item['latitude'];
            $terms_required = $item['terms_required'] ? 'true' : 'false';
            
            DB::statement("
                INSERT INTO items (
                    user_id, category, title, description, terms_required, terms_description, 
                    image, longitude, latitude, positions, created_at, updated_at
                ) VALUES (
                    {$item['user_id']}, 
                    '{$item['category']}', 
                    '{$item['title']}', 
                    '{$item['description']}', 
                    {$terms_required}, 
                    '{$item['terms_description']}', 
                    '{$item['image']}', 
                    {$item['longitude']}, 
                    {$item['latitude']}, 
                    ST_SetSRID(ST_MakePoint({$longitude}, {$latitude}), 4326),
                    NOW(),
                    NOW()
                )
            ");
        }
    }
}