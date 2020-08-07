<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{

    protected $table = 'cricket_teams';

    protected $fillable = [
        'name',
        'short_name',
        'image',
        'created_by',
        'updated_at',
        'deleted_at',
    ];

}
