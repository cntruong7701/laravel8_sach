<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function sach()
    {
        return $this->belongsTo('App\Models\Sach', 'sach_id', 'id');
    }
}
