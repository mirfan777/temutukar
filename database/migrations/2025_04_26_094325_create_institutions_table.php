<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->uuid("id");
            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 10, 8);
            $table->geometry('positions', subtype: 'point', srid: 4326);
            $table->string('name');
            $table->text('street');           // Jalan atau Blok
            $table->string('province');        // Provinsi
            $table->string('regency');         // Kabupaten/Kota
            $table->string('district');        // Kecamatan
            $table->string('village');         // Kelurahan/Desa
            $table->string('city');
            $table->string('country');
            $table->string('phone_number');
            $table->string('type'); //Panti Asuhan, Panti Jompo, Panti Rehabilitasi,
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
