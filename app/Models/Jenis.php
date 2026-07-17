<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis extends Model
{
    /** @use HasFactory<\Database\Factories\JenisFactory> */
    use HasFactory;
    protected $table = 'jenis';
    protected $fillable = [
        'name',
        'slug',
    ];
    public function posts ():HasMany{
        return $this->HasMany(Post::class);
    }
}
