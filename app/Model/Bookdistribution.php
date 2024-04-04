<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookdistribution extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'book_distribution';
    protected $fillable = [
        'id_book' ,
        'id_reader' ,
        'loan_date' ,
        'return_date',
        'status'
    ];

}