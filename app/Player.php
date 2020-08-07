<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $table = 'cricket_players';

    protected $fillable = [
        'first_name',
        'last_name',
        'specialist',
        'name',
        'jersey_no',
        'team_id',
        'no_of_match',
        'no_of_run',
        'no_of_six',
        'no_of_four',
        'no_of_wicket',
        'highest_score',
        'no_of_catch',
        'status',
        'image',
        'created_by',
        'updated_at',
        'deleted_at',
    ];

}
