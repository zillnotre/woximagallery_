<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like_foto extends Model
{
    use HasFactory;
    protected $table = 'like_foto';
    protected $primaryKey = 'id';


    public function likeable(){
        return $this->morphTo();
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
