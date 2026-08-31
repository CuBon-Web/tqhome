<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class CoreValue extends Model
{
    protected $table = 'core_values';
    protected $fillable = ['title', 'description', 'image', 'sort', 'status'];
}
