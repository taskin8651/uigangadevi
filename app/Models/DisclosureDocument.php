<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DisclosureDocument extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'section',
        'title',
        'category',
        'year',
        'external_url',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];

    protected $appends = [
        'document',
        'download_url',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('disclosure_document')->singleFile();
    }

    public function getDocumentAttribute(): ?array
    {
        $media = $this->getFirstMedia('disclosure_document');

        if (!$media) {
            return null;
        }

        return [
            'url' => $media->getUrl(),
            'name' => $media->file_name,
            'size' => $media->size,
        ];
    }

    public function getDownloadUrlAttribute(): ?string
    {
        return $this->document['url'] ?? $this->external_url;
    }
}
