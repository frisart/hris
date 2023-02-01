<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobGrade extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\JobGrade::factory(500)->create();
    }
}