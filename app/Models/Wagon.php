<?php

namespace App\Models;
use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wagon extends Model
{
    protected $table = 'wagons';
    use HasFactory;

    protected $primaryKey = 'wag_id';
    // define the sequence name used for incrementing
    // default value would be {table}_{primaryKey}_seq if not set
    protected $sequence = null;
    public $timestamps = false;
}
