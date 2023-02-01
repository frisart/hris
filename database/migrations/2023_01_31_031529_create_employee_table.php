<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id_employee');
            $table->bigInteger('emp_no');
            $table->string('nik', 100)->unique();
            $table->string('name', 100)->unique();
            $table->mediumInteger('departement')->unsigned()->index()->nullable();
            $table->foreign('departement')->references('ID_departement')->on('departement')->onDelete('no action');
            $table->mediumInteger('job_title')->unsigned()->index()->nullable();
            $table->foreign('job_title')->references('id_job_title')->on('job_title')->onDelete('no action');
            $table->mediumInteger('job_grade')->unsigned()->index()->nullable();
            $table->foreign('job_grade')->references('id_job_grade')->on('job_grade')->onDelete('no action');
            $table->mediumInteger('job_level')->unsigned()->index()->nullable();
            $table->foreign('job_level')->references('id_job_level')->on('job_level')->onDelete('no action');
            $table->string('email', 50);
            $table->string('phone', 50);
            $table->string('address', 255);
            $table->decimal('bill_rate', $precision = 8, $scale = 2)->nullable();
            $table->mediumInteger('client')->nullable();
            $table->string('birthplace', 100)->nullable();
            $table->date('birthdate')->nullable();
            $table->bigInteger('religi');
            $table->foreign('religi')->references('id_religi')->on('religi')->onDelete('no action');
            $table->bigInteger('marriage_status');
            $table->foreign('marriage_status')->references('id_marriage_status')->on('marriage_status')->onDelete('no action');
            $table->decimal('numberofchild', $precision = 8, $scale = 2)->nullable();
            $table->bigInteger('tax_status');
            $table->foreign('tax_status')->references('id_tax_status')->on('tax_status')->onDelete('no action');
            $table->string('npwp_no', 50);
            $table->text('npwp_address');
            $table->text('ktp_address');
            $table->bigInteger('blood_type');
            $table->foreign('blood_type')->references('id_blood_type')->on('blood_type')->onDelete('no action');
            $table->bigInteger('bank');
            $table->foreign('bank')->references('id_bank')->on('bank')->onDelete('no action');
            $table->string('account_bank_name', 100);
            $table->string('account_bank_number', 50);
            $table->date('join_date');
            $table->date('end_date');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}