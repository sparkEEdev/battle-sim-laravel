<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    public function armies()
    {
        return $this->hasMany(Army::class, 'game_id', 'id');
    }

    public function remaining_armies()
    {
        return $this->armies()->where('units', '>', 0);
    }
}
