<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\LikeTrait; // Import the LikeTrait

class foto extends Model
{
    use HasFactory;
    use LikeTrait; // Use the LikeTrait

    protected $table = 'foto';
    protected $primaryKey = 'id';
    protected $fillable = ['judul_foto', 'deskripsi_foto'];
    protected $dates = ['tanggal_posting'];

    protected static function boot()
    {
        parent::boot();

        // Set the tanggal_posting before saving the model
        static::creating(function ($foto) {
            $foto->tanggal_posting = Carbon::now();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function album()
    {
        return $this->belongsTo(Album::class); 
    }

    public function comments()
    {
        return $this->morphMany('App\Models\komentar_foto', 'commentable');
    }
}
