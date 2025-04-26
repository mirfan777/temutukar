<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institution;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class InstitutionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutions = [
            [
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

        foreach ($institutions as $institutionData) {
            $institution = Institution::create([
                'name' => $institutionData['name'],
                'street' => $institutionData['street'],
                'province' => $institutionData['province'],
                'regency' => $institutionData['regency'],
                'district' => $institutionData['district'],
                'village' => $institutionData['village'],
                'city' => $institutionData['city'],
                'country' => $institutionData['country'],
                'phone_number' => $institutionData['phone_number'],
                'type' => $institutionData['type'],
                'longitude' => $institutionData['longitude'],
                'latitude' => $institutionData['latitude'],
            ]);

            foreach ($institutions as $institutionData) {
                $longitude = $institutionData['longitude'];
                $latitude = $institutionData['latitude'];
                
                // Generate UUID
                $uuid = Str::uuid()->toString();
                $institutionData['id'] = $uuid;
                
                // Hapus kunci positions jika ada
                if (isset($institutionData['positions'])) {
                    unset($institutionData['positions']);
                }
                
                // Insert dengan raw SQL untuk handle spatial data
                DB::table('institutions')->insert(array_merge(
                    $institutionData,
                    ['positions' => DB::raw("ST_SetSRID(ST_MakePoint($longitude, $latitude), 4326)")]
                ));
            }
    }
}}
