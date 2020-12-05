<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
class Items extends Model
{
    use HasFactory;
    protected $fillable = ['categories_id','title','description','price','image','discount','stock','new_item','type'];
    use Translatable;
    protected $translatable = ['title','description'];


}
