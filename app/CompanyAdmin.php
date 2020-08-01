<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAdmin extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'company_admin';
    public $timestamps = false;
}
