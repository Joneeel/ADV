<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'Book_id',
        'Borrower_id',
        'DateBorrowed',
        'DueDateReturned',
        'Fullname',
    ];
}
