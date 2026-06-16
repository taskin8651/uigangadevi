<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FacultyMember extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'faculty_members';

    protected $fillable = [
        'subject_id',
        'name',
        'slug',
        'faculty_category',
        'designation',
        'employee_id',
        'email',
        'phone',
        'joining_date',
        'teaching_experience',
        'research_experience',
        'short_description',
        'biography',
        'qualifications',
        'specializations',
        'subjects_taught',
        'research_interests',
        'publications',
        'awards',
        'responsibilities',
        'memberships',
        'seminars',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'qualifications' => 'array',
        'specializations' => 'array',
        'subjects_taught' => 'array',
        'research_interests' => 'array',
        'publications' => 'array',
        'awards' => 'array',
        'responsibilities' => 'array',
        'memberships' => 'array',
        'seminars' => 'array',
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];

    protected $appends = [
        'image',
        'cv',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('faculty_image')
            ->singleFile();

        $this
            ->addMediaCollection('faculty_cv')
            ->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('faculty_image');

        return $media ? $media->getUrl() : null;
    }

    public function getCvAttribute(): ?array
    {
        $media = $this->getFirstMedia('faculty_cv');

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