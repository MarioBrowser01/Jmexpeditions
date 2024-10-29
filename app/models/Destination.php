<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'location', 'price',
    ];

    // Relaciones con otros modelos, por ejemplo con 'Package'
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
