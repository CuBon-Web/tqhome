<?php

namespace App\Http\Controllers\Api\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\website\HistoryMilestone;

class HistoryMilestoneController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        if ($request->data) {
            HistoryMilestone::truncate();
            foreach ($request->data as $index => $value) {
                HistoryMilestone::create([
                    'year'        => $value['year'] ?? '',
                    'title'       => $value['title'] ?? '',
                    'description' => $value['description'] ?? '',
                    'sort'        => $index + 1,
                    'status'      => $value['status'] ?? 1,
                ]);
            }
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function list()
    {
        $data = HistoryMilestone::orderBy('sort')->orderBy('id')->get();

        return response()->json(['message' => 'success', 'data' => $data], 200);
    }
}
