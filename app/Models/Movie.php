<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'publishDate',
        'image'
    ];
    public $incrementing = false;

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('seconds');
    }

    public static function getMovieById($id)
    {
        $movie = Movie::query()->findOrFail($id);
        return $movie;
    }
}
