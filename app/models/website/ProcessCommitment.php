<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class ProcessCommitment extends Model
{
    protected $table = 'process_commitments';
    protected $fillable = ['title', 'description', 'image', 'sort', 'status'];
}
