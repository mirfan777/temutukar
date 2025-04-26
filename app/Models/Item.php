<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'description',
        'terms_required',
        'terms_description',
        'image',
        'longitude',
        'latitude',
        'positions'
    ];

    protected static function booted()
    {
        static::saving(function ($item) {
            // Kalau longitude dan latitude ada, buat geometry Point
            if ($item->longitude && $item->latitude) {
                $item->positions = DB::raw("ST_SetSRID(ST_MakePoint({$item->longitude}, {$item->latitude}), 4326)");
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}