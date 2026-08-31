<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class ProductProfileCategory extends Model
{
    protected $table = 'product_profile_categories';
    protected $fillable = ['title', 'description', 'image', 'slug', 'sort', 'status'];

    public function documents()
    {
        return $this->hasMany(ProductProfileDocument::class, 'category_id')
            ->orderBy('sort')
            ->orderBy('id');
    }
}
