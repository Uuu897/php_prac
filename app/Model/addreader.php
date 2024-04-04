<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addreader extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'reader';
    protected $fillable = [
        'FIO',
        'email',
    ];
}