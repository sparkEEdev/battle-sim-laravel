<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Army extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'name',
        'initial_units',
        'units',
        'attack_strategy',
        'ordinal'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function setInitialUnitsAttribute($value)
    {
        $this->attributes['initial_units'] = $value;
        $this->attributes['units'] = $value;
    }


    public function getDamageAttribute()
    {
        // The army always does 0.5 damage per unit, when an attack is successful.
        // If there is only one unit left, the damage is 1.

        // * 0.5 OR / 2
        return $this->units > 1 ?  round($this->units * 0.5, 0, PHP_ROUND_HALF_DOWN) : 1;
    }
}
