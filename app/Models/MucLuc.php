<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MucLuc extends Model
{
    use HasFactory;
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'sach_id','tieude', 'tomtat','noidung', 'kichhoat', 'slug_mucluc',
    ];
    protected $primaryKey = 'id';
    protected $table = 'mucluc';

    public function sach()
    {
        return $this->belongsTo('App\Models\Sach');
    }
}
