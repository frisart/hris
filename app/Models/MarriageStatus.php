<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarriageStatus extends Model
{
    use HasFactory;

    protected $table = 'marriage_status';
    protected $fillable = ['id_marriage_status', 'name', 'order', 'active'];
    public $timestamps = true;
    protected $primaryKey = 'id_marriage_status';
}