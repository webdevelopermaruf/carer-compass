<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;

class CarerProviders extends Authenticatable
{
    use HasFactory, Notifiable;
    public $table = 'carer-providers';

    public function review(){
        return $this->hasMany(Reviews::class, 'carer_providers_id', 'id');
    }
}
