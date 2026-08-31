<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\website\ProductProfileCategory;
use App\models\website\ProductProfileDocument;

class ProductProfileController extends Controller
{
    public function listCategories()
    {
        $categories = ProductProfileCategory::orderBy('sort')->orderBy('id')->get();

        $data = $categories->map(function ($category) {
            $category->documents_count = ProductProfileDocument::where('category_id', $category->id)->count();
            return $category;
        });

        return response()->json([
            'message' => 'success',
            'data'    => $data,
        ], 200);
    }

    public function getCategory($id)
    {
        $category = ProductProfileCategory::findOrFail($id);
        $documents = ProductProfileDocument::where('category_id', $category->id)
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
            ->map(function ($doc) {
                $images = json_decode($doc->images, true);
                $doc->images = is_array($images) ? $images : [];
                return $doc;
            });

        $category->documents = $documents;

        return response()->json([
            'message' => 'success',
            'data'    => $category,
        ], 200);
    }

    public function saveCategory(Request $request)
    {
        $id = $request->id ?? null;
        $title = trim($request->title ?? '');

        if ($title === '') {
            return response()->json(['message' => 'Tiêu đề không được để trống'], 422);
        }

        $payload = [
            'title'       => $title,
            'description' => $request->description ?? '',
            'image'       => $request->image ?? '',
            'slug'        => to_slug($title),
            'sort'        => $request->sort ?? 0,
            'status'      => $request->status ?? 1,
        ];

        if ($id) {
            $category = ProductProfileCategory::findOrFail($id);
            $category->update($payload);
        } else {
            $category = ProductProfileCategory::create($payload);
        }

        return response()->json([
            'message' => 'success',
            'data'    => $category,
        ], 200);
    }

    public function deleteCategory($id)
    {
        $category = ProductProfileCategory::findOrFail($id);
        ProductProfileDocument::where('category_id', $category->id)->delete();
        $category->delete();

        return response()->json(['message' => 'success'], 200);
    }

    public function saveDocuments(Request $request, $categoryId)
    {
        ProductProfileCategory::findOrFail($categoryId);

        $documents = $request->documents ?? [];
        ProductProfileDocument::where('category_id', $categoryId)->delete();

        foreach ($documents as $j => $doc) {
            $docTitle = trim($doc['title'] ?? '');
            $images = $doc['images'] ?? [];
            if (is_array($images)) {
                $images = json_encode(array_values(array_filter($images)));
            }

            if ($docTitle === '' && empty(json_decode($images ?: '[]', true))) {
                continue;
            }

            ProductProfileDocument::create([
                'category_id' => $categoryId,
                'title'       => $docTitle !== '' ? $docTitle : ('Hồ sơ ' . ($j + 1)),
                'images'      => $images ?: '[]',
                'sort'        => $doc['sort'] ?? $j,
                'status'      => $doc['status'] ?? 1,
            ]);
        }

        return response()->json(['message' => 'success'], 200);
    }
}
