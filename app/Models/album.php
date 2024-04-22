<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Album extends Model
{
    use HasFactory;

    protected $table = 'album';

    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_album',
        'deskripsi',
        'user_id',
    ];

    protected $dates = ['tanggal_dibuat'];

    protected static function boot()
    {
        parent::boot();

        // Set the tanggal_dibuat before saving the model
        static::creating(function ($album) {
            $album->tanggal_dibuat = Carbon::now();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function foto()
    {
        return $this->hasMany(Foto::class);
    }
}
