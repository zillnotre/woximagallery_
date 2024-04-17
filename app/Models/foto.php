<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;




class foto extends Model
{
    use HasFactory;
    protected $table = 'foto';
    protected $primaryKey = 'id';
    protected $fillable = ['judul_foto','deskripsi_foto'];
    protected $dates = ['tanggal_posting'];

protected static function boot()
{
    parent::boot();

    // Menetapkan tanggal_posting sebelum model disimpan
    static::creating(function ($foto) {
        $foto->tanggal_posting = Carbon::now();
    });
}


    public function User(){
        return $this->belongsTo('App\Models\User');
    }

}



