<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chuong extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id_truyen','tenchuong','slug_chuong','noidung'];
    //protected $primaryKey = 'id';
    protected $table = 'chuong';

    public function truyen(){
        return $this->belongsTo('App\Models\Truyen','id_truyen','id');
    }

}
