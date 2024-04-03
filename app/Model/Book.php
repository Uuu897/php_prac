<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'book';
    protected $fillable = [
        'title_book',
        'annotacia' ,
        'id_genre' ,
        'id_author' ,
        'publication_year' ,
        'new_edition_or_not'

    ];
}