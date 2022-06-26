<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['tentruyen','slug_truyen','tomtat','id_theloai','hinhanh'];
    //protected $primaryKey = 'id';
    protected $table = 'truyen';

    public function theloai(){
        return $this->belongsTo('App\Models\Theloai','id_theloai','id');
    }
}
