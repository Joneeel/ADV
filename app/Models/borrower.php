<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrower extends Model
{
    use HasFactory;
/* A list of attributes that can be mass assigned. */
    protected $fillable = [
        'fullname',
        'gender',
        'address',
    ];
}
