<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class ProcessPageSetting extends Model
{
    protected $table = 'process_page_settings';
    protected $fillable = [
        'page_title',
        'intro_content',
        'hero_image',
        'commitment_title',
        'commitment_image',
    ];
}
