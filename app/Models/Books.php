<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model {
    protected $table = 'tblbooks';
    protected $fillable = [
        'id', 'bookname', 'yearpublish', 'authorid',
    ];

    public $timestamp = false;
    protected $primaryKey = 'id';
}

?>