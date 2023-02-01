<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;

    protected $table = 'blood_type';
    protected $fillable = ['id_blood_type', 'name', 'order', 'active'];
    public $timestamps = true;
    protected $primaryKey = 'id_blood_type';
}