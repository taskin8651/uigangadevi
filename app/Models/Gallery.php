<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'category',
        'type',
        'description',
        'video_url',
        'sort_order',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    protected $appends = [
        'image',
        'video_embed_url',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('gallery_image')
            ->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('gallery_image');

        return $media ? $media->getUrl() : null;
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        if (str_contains($this->video_url, 'youtube.com/watch')) {
            parse_str(parse_url($this->video_url, PHP_URL_QUERY) ?: '', $query);

            return isset($query['v'])
                ? 'https://www.youtube.com/embed/' . $query['v']
                : $this->video_url;
        }

        if (str_contains($this->video_url, 'youtu.be/')) {
            return 'https://www.youtube.com/embed/' . basename(parse_url($this->video_url, PHP_URL_PATH));
        }

        return $this->video_url;
    }
}
