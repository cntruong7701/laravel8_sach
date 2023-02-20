<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tieude', 'meta_seo', 'meta_icon','nutmangxahoi', 'logo'
    ];
    protected $primaryKey = 'id';
    protected $table = 'information';

}
