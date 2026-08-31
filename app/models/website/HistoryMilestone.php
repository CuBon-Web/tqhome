<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class HistoryMilestone extends Model
{
    protected $table = 'history_milestones';
    protected $fillable = ['year', 'title', 'description', 'sort', 'status'];
}
