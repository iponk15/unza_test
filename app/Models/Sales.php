<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public $timestamps    = false;
    protected $table      = 'sales_supervisor';
    protected $primaryKey = 'sales_id';
    protected $fillable   = [
        'sales_kode',
        'sales_nama'
    ];
}
