<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModDist extends Model
{
    public $timestamps    = false;
    protected $table      = 'distributor';
    protected $primaryKey = 'dist_id';
    protected $fillable   = [
        'dist_kode',
        'dist_nama'
    ];
}
