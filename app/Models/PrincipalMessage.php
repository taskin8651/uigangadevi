<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PrincipalMessage extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'principal_name',
        'college_name',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $appends = [
        'image',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('principal_image')
            ->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia('principal_image');

        return $media ? $media->getUrl() : null;
    }
}