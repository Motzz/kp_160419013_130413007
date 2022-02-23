<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PT extends Model
{
    protected $table = 'pt';
    use HasFactory;
     protected $fillable=[
        'name',
        'Alias'
    ];
}
