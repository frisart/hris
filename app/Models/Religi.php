<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religi extends Model
{
    use HasFactory;

    protected $table = 'religi';
    protected $fillable = ['id_religi', 'name', 'order', 'active'];
    public $timestamps = true;
    protected $primaryKey = 'id_religi';
}