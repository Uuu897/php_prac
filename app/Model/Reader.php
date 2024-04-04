<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'reader';
    protected $fillable = [
        'email' ,
        'FIO',
    ];
}