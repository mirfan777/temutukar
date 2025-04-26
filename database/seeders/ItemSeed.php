<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Items (10 items di Jakarta)
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
        
        foreach ($items as $itemData) {
            $item = Item::create([
                'user_id' => $itemData['user_id'],
                'category' => $itemData['category'],
                'title' => $itemData['title'],
                'description' => $itemData['description'],
                'terms_required' => $itemData['terms_required'],
                'terms_description' => $itemData['terms_description'],
                'image' => $itemData['image'],
                'longitude' => $itemData['longitude'],
                'latitude' => $itemData['latitude'],
            ]);

            foreach ($items as $itemData) {
                $longitude = $itemData['longitude'];
                $latitude = $itemData['latitude'];
                
                // Hapus kunci positions jika ada
                if (isset($itemData['positions'])) {
                    unset($itemData['positions']);
                }
                
                // Insert dengan raw SQL untuk handle spatial data
                DB::table('items')->insert(array_merge(
                    $itemData,
                    ['positions' => DB::raw("ST_SetSRID(ST_MakePoint($longitude, $latitude), 4326)")],
                    ['created_at' => now(), 'updated_at' => now()]
                ));
            }
        }
    }
}
