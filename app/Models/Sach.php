<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\DanhMuc;

class Sach extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
    protected $fillable = [
        'tensach', 'tacgia', 'tomtat', 'kichhoat','slug_sach', 'hinhanh', 'danhmuc_id', 'theloai_id', 'sochuong',
        'view','create_at', 'updated_at', 'sach_noibat'
    ];
    protected $primaryKey = 'id';
    protected $table = 'sach';

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

    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class);
    }

    // public function thuocnhieudanhmuc()
    // {
    //     return $this->belongsToMany(DanhMuc::class, 'thuocdanh', 'sach_id', 'danhmuc_id');
    // }
}
