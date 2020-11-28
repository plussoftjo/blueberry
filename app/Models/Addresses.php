<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    protected $fillable =['user_id','city','area','address','note','latitude','longitude'];

    public function User() {
        return $this->belongsTo('App\Models\User');
    }
}
