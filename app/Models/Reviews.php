<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parents_id', 'id');
    }
}
