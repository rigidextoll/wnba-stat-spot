<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WnbaPlayer extends Model
{
    protected $fillable = [
        'athlete_id',
        'athlete_display_name',
        'athlete_short_name',
        'athlete_jersey',
        'athlete_headshot_href',
        'athlete_position_name',
        'athlete_position_abbreviation',
    ];

    public function playerGames(): HasMany
    {
        return $this->hasMany(WnbaPlayerGame::class, 'player_id');
    }

    public function plays(): HasMany
    {
        return $this->hasMany(WnbaPlay::class, 'player_id');
    }
}
