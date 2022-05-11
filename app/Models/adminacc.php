<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminacc extends Model
{
    use HasFactory;
/* A list of the fields that can be mass assigned. */
    protected $fillable = [
        'name',
        'username',
        'password',
    ];
}
