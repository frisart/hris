<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $table = 'job_title';
    protected $fillable = ['id_job_title', 'departement','name','order','active'];
    public $timestamps = true;
    protected $primaryKey = 'id_job_title';
}
