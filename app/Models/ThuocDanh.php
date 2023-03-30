<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuocDanh extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'danhmuc_id', 'sach_id'
    ];

    protected $primaryKey = 'id';
    protected $table = 'thuocdanh';

    
}
