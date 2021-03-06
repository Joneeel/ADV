<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
/* Telling the model what fields are allowed to be filled in. */
    protected $fillable = [
        'Title',
        'Author',
        'Copyright',
        'No_pages',
        'Stock',
    ];
}
