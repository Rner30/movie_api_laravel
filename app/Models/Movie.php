<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

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
}
