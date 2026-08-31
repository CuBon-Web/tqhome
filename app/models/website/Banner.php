<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banners";
    protected $fillable = [
        'id',
        'image',
        'image_mobile',
        'type',
        'video_url',
        'status',
        'link',
        'title',
        'description',
    ];

    public function isVideo()
    {
        return in_array($this->type, ['video', 'youtube'], true)
            && !empty($this->video_url)
            && !$this->isYoutubeUrl($this->video_url);
    }

    public function getYoutubeIdAttribute()
    {
        if (!in_array($this->type, ['youtube', 'video'], true) || empty($this->video_url)) {
            return null;
        }

        return $this->extractYoutubeId($this->video_url);
    }

    public function isYoutube()
    {
        return $this->type === 'youtube' && $this->youtube_id;
    }

    protected function isYoutubeUrl($url)
    {
        return (bool) $this->extractYoutubeId($url);
    }

    protected function extractYoutubeId($url)
    {
        $url = trim((string) $url);

        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        if (preg_match(
            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
            $url,
            $matches
        )) {
            return $matches[1];
        }

        return null;
    }
}
