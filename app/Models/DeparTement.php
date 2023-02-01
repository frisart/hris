<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Kalnoy\Nestedset\NodeTrait;

class DeparTement extends Model
{
    // use NodeTrait;

    protected $table = 'departement';
    protected $fillable = ['ID_departement', 'Parent', 'name', 'order', 'departement_head', 'active'];
    public $timestamps = true;
    protected $primaryKey = 'ID_departement';
}