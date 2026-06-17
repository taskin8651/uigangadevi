<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class StudentActivity extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'student_activities';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'activity_date',
        'venue',
        'organizer',
        'guest_name',
        'short_description',
        'description',
        'activity_highlights',
        'learning_outcomes',
        'participants',
        'is_featured',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'activity_highlights' => 'array',
        'learning_outcomes' => 'array',
        'participants' => 'array',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];

    protected $appends = [
        'image',
        'gallery',
        'document',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('activity_image')
            ->singleFile();

        $this->addMediaCollection('activity_gallery');

        $this
            ->addMediaCollection('activity_document')
            ->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('activity_image');

        return $media ? $media->getUrl() : null;
    }

    public function getGalleryAttribute(): array
    {
        return $this
            ->getMedia('activity_gallery')
            ->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                    'name' => $media->file_name,
                    'size' => $media->size,
                ];
            })
            ->values()
            ->all();
    }

    public function getDocumentAttribute(): ?array
    {
        $media = $this->getFirstMedia('activity_document');

        if (!$media) {
            return null;
        }

        return [
            'url' => $media->getUrl(),
            'name' => $media->file_name,
            'size' => $media->size,
        ];
    }
}
