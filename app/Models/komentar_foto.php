<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar_foto extends Model
{
    use HasFactory;

    protected $table = 'komentar_foto';
    protected $primaryKey = 'id';
    protected $fillable = ['isi_komentar'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
