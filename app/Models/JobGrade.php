<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobGrade extends Model
{
    use HasFactory;

    protected $table = 'job_grade';
    protected $fillable = ['id_job_grade','name','order','active'];
    public $timestamps = true;
    protected $primaryKey = 'id_job_grade';
}
