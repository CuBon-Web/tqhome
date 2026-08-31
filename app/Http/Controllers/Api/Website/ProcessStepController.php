<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\website\ProcessStep;
use App\models\website\ProcessPageSetting;
use App\models\website\ProcessCommitment;

class ProcessStepController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        if ($request->page) {
            $page = $request->page;
            $setting = ProcessPageSetting::first();
            if (!$setting) {
                $setting = new ProcessPageSetting();
            }
            $setting->page_title = $page['page_title'] ?? 'Quy trình cung ứng';
            $setting->intro_content = $page['intro_content'] ?? '';
            $setting->hero_image = $page['hero_image'] ?? '';
            $setting->commitment_title = $page['commitment_title'] ?? 'Cam kết của Kỳ Linh Food';
            $setting->commitment_image = $page['commitment_image'] ?? '';
            $setting->save();
        }

        $items = $request->items ?? [];
        ProcessStep::truncate();
        foreach ($items as $i => $item) {
            $checklist = $item['checklist'] ?? [];
            if (is_array($checklist)) {
                $checklist = json_encode(array_values(array_filter(array_map('trim', $checklist))));
            }

            ProcessStep::create([
                'title'       => $item['title'] ?? '',
                'icon'        => $item['icon'] ?? '',
                'description' => $item['description'] ?? '',
                'image'       => $item['image'] ?? '',
                'checklist'   => $checklist ?: null,
                'link'        => $item['link'] ?? '',
                'sort'        => $item['sort'] ?? $i,
                'status'      => $item['status'] ?? 1,
            ]);
        }

        $commitments = $request->commitments ?? [];
        ProcessCommitment::truncate();
        foreach ($commitments as $i => $item) {
            ProcessCommitment::create([
                'title'       => $item['title'] ?? '',
                'description' => $item['description'] ?? '',
                'image'       => $item['image'] ?? '',
                'sort'        => $item['sort'] ?? $i,
                'status'      => $item['status'] ?? 1,
            ]);
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function list()
    {
        $page = ProcessPageSetting::first();
        $data = ProcessStep::orderBy('sort')->orderBy('id')->get();
        $commitments = ProcessCommitment::orderBy('sort')->orderBy('id')->get();

        return response()->json([
            'message'     => 'success',
            'page'        => $page,
            'data'        => $data,
            'commitments' => $commitments,
        ], 200);
    }
}
