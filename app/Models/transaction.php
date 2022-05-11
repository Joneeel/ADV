<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
/* A list of the columns in the table that can be filled in. */
    protected $fillable = [
        'Book_id',
        'Borrower_id',
        'DateBorrowed',
        'DueDateReturned',
        'Fullname',
    ];
}
