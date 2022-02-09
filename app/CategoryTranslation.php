<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\False_;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
