<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class ProductProfileDocument extends Model
{
    protected $table = 'product_profile_documents';
    protected $fillable = ['category_id', 'title', 'images', 'sort', 'status'];

    public function category()
    {
        return $this->belongsTo(ProductProfileCategory::class, 'category_id');
    }
}
