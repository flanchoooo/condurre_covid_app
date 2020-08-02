<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Questionnaire extends Model implements Authenticatable

{

    use AuthenticableTrait;

    protected $guarded = [];

    protected $connection = 'questions';
    protected $table = 'visit';

}
