<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;
/* A list of the columns in the table. */
    protected $fillable = [
        'Borrower_id',
        'Book_id',
        'Date_Returned',
        'Date_Borrowed',
    ];
}
