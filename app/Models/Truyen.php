<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;

    protected $fillable = [
        'tentruyen', 'tacgia', 'tomtat', 'kichhoat','slug_truyen', 'hinhanh', 'danhmuc_id', 'theloai_id', 
        'view','create_at', 'updated_at', 'truyen_noibat'
    ];

    protected $primaryKey = 'id';
    protected $table = 'truyen';

    public function danhmuc()
    {
        return $this->belongsTo('App\Models\DanhMuc', 'danhmuc_id', 'id');
    }

    public function mucluc()
    {
        return $this->hasMany('App\Models\MucLuc','sach_id', 'id');
    }

    public function theloai()
    {
        return $this->belongsTo('App\Models\TheLoai', 'theloai_id', 'id');
    }

    public function thuocnhieudanhmuc()
    {
        return $this->belongsToMany(DanhMuc::class,'thuocdanh', 'truyen_id', 'danhmuc_id');
    }

    public function thuocnhieutheloai()
    {
        return $this->belongsToMany(TheLoai::class,'thuocloai', 'truyen_id', 'theloai_id');
    }
}
