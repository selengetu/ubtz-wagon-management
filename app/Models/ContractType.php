<?php

namespace App\Models;
use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    protected $table = 'SET_CONTRACT_TYPES';
    use HasFactory;

    protected $primaryKey = 'contract_type_code';
    // define the sequence name used for incrementing
    // default value would be {table}_{primaryKey}_seq if not set
    protected $sequence = null;
    public $timestamps = false;
}
