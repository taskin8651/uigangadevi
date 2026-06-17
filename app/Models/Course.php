<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'short_name',
        'level',
        'duration',
        'course_type',
        'short_description',
        'description',
        'eligibility',
        'admission_process',
        'highlights',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'highlights' => 'array',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = [
        'image',
    ];

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'course_subject'
        )->withTimestamps();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('course_image')
            ->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('course_image');

        return $media ? $media->getUrl() : null;
    }

    public function syllabusDocuments()
{
    return $this->hasMany(
        SyllabusDocument::class
    );
}
}