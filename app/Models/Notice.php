<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Notice extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'notice_date',
        'short_description',
        'external_url',
        'button_text',
        'is_latest',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'notice_date' => 'date',
        'is_latest' => 'boolean',
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];

    protected $appends = [
        'document',
        'download_url',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('notice_document')
            ->singleFile();
    }

    public function getDocumentAttribute(): ?array
    {
        $media = $this->getFirstMedia('notice_document');

        if (!$media) {
            return null;
        }

        return [
            'id' => $media->id,
            'url' => $media->getUrl(),
            'name' => $media->file_name,
            'mime_type' => $media->mime_type,
            'size' => $media->size,
        ];
    }

    public function getDownloadUrlAttribute(): ?string
    {
        if ($this->document) {
            return $this->document['url'];
        }

        return $this->external_url ?: null;
    }
}
