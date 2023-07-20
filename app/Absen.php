<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absens';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'kategori', 'waktu', 'jam'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
