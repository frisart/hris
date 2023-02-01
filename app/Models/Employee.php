<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $fillable = ['id_employee', 'emp_no', 'nik', 'name', 'departement', 'job_title', 'job_grade', 'job_level', 'email', 'phone', 'address', 'bill_rate', 'client', 'birthplace', 'birthdate', 'religi', 'marriage_status', 'numberofchild', 'tax_status', 'npwp_no', 'npwp_address', 'ktp_address', 'blood_type', 'bank', 'account_bank_name', 'account_bank_number', 'join_date', 'end_date', 'active'];
    public $timestamps = true;
    protected $primaryKey = 'id_employee';
}