<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
class Categories extends Model
{
    use HasFactory;

    protected $fillable= ['title','description','image'];
    use Translatable;
    protected $translatable = ['title','description'];
}
