<?php

namespace App\Http\Controllers\Api\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\website\CoreValue;

class CoreValueController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        if ($request->data) {
            CoreValue::truncate();
            foreach ($request->data as $index => $value) {
                CoreValue::create([
                    'title'       => $value['title'] ?? '',
                    'description' => $value['description'] ?? '',
                    'image'       => $value['image'] ?? '',
                    'sort'        => $index + 1,
                    'status'      => $value['status'] ?? 1,
                ]);
            }
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function list()
    {
        $data = CoreValue::orderBy('sort')->get();

        return response()->json(['message' => 'success', 'data' => $data], 200);
    }
}
