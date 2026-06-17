<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SyllabusDocument extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'syllabus_documents';

    protected $fillable = [
        'course_id',
        'subject_id',
        'title',
        'slug',
        'academic_session',
        'semester',
        'document_type',
        'curriculum_type',
        'effective_from',
        'short_description',
        'external_url',
        'button_text',
        'is_featured',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'course_id'    => 'integer',
        'subject_id'   => 'integer',
        'is_featured'  => 'boolean',
        'sort_order'   => 'integer',
        'status'       => 'boolean',
    ];

    protected $appends = [
        'document',
        'download_url',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('syllabus_document')
            ->singleFile();
    }

    public function getDocumentAttribute(): ?array
    {
        $media = $this->getFirstMedia('syllabus_document');

        if (!$media) {
            return null;
        }

        return [
            'id'        => $media->id,
            'url'       => $media->getUrl(),
            'name'      => $media->file_name,
            'mime_type' => $media->mime_type,
            'size'      => $media->size,
        ];
    }

    public function getDownloadUrlAttribute(): ?string
    {
        if ($this->document) {
            return $this->document['url'];
        }

        return $this->external_url ?: null;
    }

    public function syllabusDocuments()
{
    return $this->hasMany(
        SyllabusDocument::class
    );
}
}