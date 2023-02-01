<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLevel extends Model
{
    use HasFactory;

    protected $table = 'job_level';
    protected $fillable = ['id_job_level','name','order','active'];
    public $timestamps = true;
    protected $primaryKey = 'id_job_level';
}
