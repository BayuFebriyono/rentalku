<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table ='detail_transaksi';
    protected $guarded = ['id'];

    public function tipe(){
        return $this->belongsTo(Tipe::class);
    }

    public function karyawan(){
        return $this->belongsTo(Karyawan::class);
    }
}
