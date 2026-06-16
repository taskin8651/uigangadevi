<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Subject extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'department_name',
        'short_name',
        'short_description',
        'description',
        'academic_areas',
        'learning_outcomes',
        'career_opportunities',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'academic_areas' => 'array',
        'learning_outcomes' => 'array',
        'career_opportunities' => 'array',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = [
        'image',
        'syllabus',
    ];

    public function courses()
    {
        return $this->belongsToMany(
            Course::class,
            'course_subject'
        )->withTimestamps();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('subject_image')
            ->singleFile();

        $this
            ->addMediaCollection('subject_syllabus')
            ->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('subject_image');

        return $media ? $media->getUrl() : null;
    }

    public function getSyllabusAttribute(): ?array
    {
        $media = $this->getFirstMedia('subject_syllabus');

        if (!$media) {
            return null;
        }

        return [
            'url' => $media->getUrl(),
            'name' => $media->file_name,
            'size' => $media->size,
        ];
    }

    public function facultyMembers()
    {
        return $this->hasMany(FacultyMember::class);
    }
}
