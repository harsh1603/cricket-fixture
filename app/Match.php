<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{

    protected $table = 'cricket_match';

    protected $fillable = [
        'team_a_id',
        'team_b_id',
        'venue',
        'match_date',
        'match_status',
        'win_team_id',
        'created_by',
        'updated_at',
        'deleted_at',
    ];

}
