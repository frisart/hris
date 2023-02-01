<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxStatus extends Model
{
    use HasFactory;

    protected $table = 'tax_status';
    protected $fillable = ['id_tax_status', 'name', 'order', 'active'];
    public $timestamps = true;
    protected $primaryKey = 'id_tax_status';
}