<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CarerProviders extends Authenticatable
{
    public $table = 'carer-providers';

    public function review(){
        return $this->hasMany(Reviews::class, 'carer_providers_id', 'id');
    }
}
