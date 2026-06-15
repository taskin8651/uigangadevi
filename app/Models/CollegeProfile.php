<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CollegeProfile extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'college_profiles';

    protected $fillable = [
        'about_badge',
        'about_title',
        'about_description_one',
        'about_description_two',
        'image_badge_title',
        'image_badge_subtitle',
        'about_points',

        'vision_title',
        'vision_description',
        'vision_points',

        'mission_title',
        'mission_description',
        'mission_points',

        'core_value_title',
        'core_value_description',
        'core_value_points',

        'status',
    ];

    protected $casts = [
        'about_points'      => 'array',
        'vision_points'     => 'array',
        'mission_points'    => 'array',
        'core_value_points' => 'array',
        'status'            => 'boolean',
    ];

    protected $appends = [
        'profile_image',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('college_profile_image')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('profile_thumb')
            ->width(900)
            ->height(700)
            ->sharpen(10)
            ->nonQueued();
    }

    public function getProfileImageAttribute(): ?array
    {
        $media = $this->getFirstMedia('college_profile_image');

        if (!$media) {
            return null;
        }

        return [
            'id'          => $media->id,
            'url'         => $media->getUrl(),
            'preview'     => $media->getUrl('profile_thumb'),
            'name'        => $media->name,
            'file_name'   => $media->file_name,
            'mime_type'   => $media->mime_type,
            'size'        => $media->size,
        ];
    }
}