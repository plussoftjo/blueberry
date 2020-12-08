<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','addresses_id','payment','total','time','note','status','discount_id','driver_id'];
    public $with = ['OrderItems'];

    public function OrderItems() {
        return $this->hasMany('App\Models\OrderItems');
    }

    public function User() {
        return $this->belongsTo('App\Models\User');
    }

    public function Addresses() {
        return $this->belongsTo('App\Models\Addresses');
    }
}
