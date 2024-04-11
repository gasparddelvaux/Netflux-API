<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'movies';
    protected $fillable = [
        'name',
        'year',
        'director_id',
        'synopsis',
        'cover',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }
}
