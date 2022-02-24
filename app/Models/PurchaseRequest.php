<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable=[
        'name',
        'totalHarga',
        'idLokasi',
        'date',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'approved',
    ];
}
