<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Institution extends Model
{
    use HasFactory;

    public $incrementing = false; // Karena id UUID
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'street',
        'province',
        'regency',
        'district',
        'village',
        'city',
        'country',
        'phone_number',
        'type',
        'longitude',
        'latitude',
        'positions'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
            
            // Buat Point geometry dari longitude dan latitude
            if ($model->longitude && $model->latitude) {
                $model->positions = DB::raw("ST_SetSRID(ST_MakePoint({$model->longitude}, {$model->latitude}), 4326)");
            }
        });
    }
}