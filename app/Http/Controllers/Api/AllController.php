<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Librarys;
use App\models\MessContact;
use App\Services\CloudflareImageService;

class AllController extends Controller
{
    protected $apiToken;
    protected $accountId;
    protected $cloudflareService;

    public function __construct(CloudflareImageService $cloudflareService)
    {
        $this->cloudflareService = $cloudflareService;
    }
    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('img')) {
            return response()->json(['data' => 'fail'], 500);
        }

        $image = $request->file('img');
        $response = $this->cloudflareService->uploadImage($image);

        if (empty($response['success']) || empty($response['result']['variants'][0])) {
            return response()->json([
                'data' => 'fail',
                'errors' => $response['errors'] ?? null,
            ], 500);
        }

        return response()->json([
            'messenge' => 'success',
            'path' => $response['result']['variants'][0],
        ], 200);
    }
    public function uploadVideo(Request $request)
    {
        if (!$request->hasFile('video')) {
            return response()->json([
                'data' => 'fail',
                'message' => 'Vui lòng chọn file video.',
            ], 400);
        }

        $file = $request->file('video');
        $ext = strtolower($file->getClientOriginalExtension() ?: '');
        $allowedExt = ['mp4', 'webm', 'mov', 'm4v'];
        $maxBytes = 80 * 1024 * 1024;

        if (!in_array($ext, $allowedExt, true)) {
            return response()->json([
                'data' => 'fail',
                'message' => 'Chỉ chấp nhận video MP4, WebM hoặc MOV.',
            ], 422);
        }

        if ($file->getSize() > $maxBytes) {
            return response()->json([
                'data' => 'fail',
                'message' => 'Video không được vượt quá 80MB.',
            ], 422);
        }

        $dir = public_path('uploads/videos');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = 'banner-' . date('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
        $file->move($dir, $name);

        return response()->json([
            'messenge' => 'success',
            'path' => '/uploads/videos/' . $name,
        ], 200);
    }

    public function uploadImageMulti(Request $request)
    {
        $uploadId = [];
        if($files = $request->file('file')){
            foreach($request->file('file') as $key => $file){
                $name = rand().$file->getClientOriginalName();
                $fielname = $file->move('uploads/imagesMuli/', $name);
                $uploadId[] = '/uploads/images/'.$name;
            }
        }
        return response()->json([
            'messenge' => 'success',
            'path' => $uploadId
        ],200);
    }
    public function fileStore(Request $request)
    {
        $upload_path = public_path('upload');
        $file_name = $request->file->getClientOriginalName();
        $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($upload_path, $generated_new_name);
         
        $insert['title'] = $generated_new_name;
        return response()->json([
            'messenge' => 'success',
            'path' => $insert
        ],200);
    }
    public function listMesscontact(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword == ""){
            $data = MessContact::orderBy('id','DESC')->get();
        }else{
            $data = MessContact::where('title', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
}
