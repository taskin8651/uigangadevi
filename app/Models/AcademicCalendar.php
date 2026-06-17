<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AcademicCalendar extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'academic_calendars';

    protected $fillable = [
        'title',
        'academic_session',
        'short_description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $appends = [
        'document',
    ];

    public function months()
    {
        return $this->hasMany(
            AcademicCalendarMonth::class
        );
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('academic_calendar_document')
            ->singleFile();
    }

    public function getDocumentAttribute(): ?array
    {
        $media = $this->getFirstMedia(
            'academic_calendar_document'
        );

        if (!$media) {
            return null;
        }

        return [
            'id' => $media->id,
            'url' => $media->getUrl(),
            'name' => $media->file_name,
            'size' => $media->size,
        ];
    }
}