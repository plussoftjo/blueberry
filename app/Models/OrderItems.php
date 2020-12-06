<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = ['orders_id','items_id','qty','note','total'];

    public $with = ['Items'];

    public function Orders() {
        return $this->belongsTo('App\Models\Orders');
    }

    public function Items() {
        return $this->belongsTo('App\Models\Items');
    }
}
