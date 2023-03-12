<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tenDM', 'mota', 'kichHoat','slug_danhmuc'
    ];
    protected $primaryKey = 'id';
    protected $table = 'danhmuc';

    public function sach()
    {
        return $this->hasMany('App\Models\Sach');
    }

    public function truyen()
    {
        return $this->hasMany('App\Models\Truyen');
    }
}
