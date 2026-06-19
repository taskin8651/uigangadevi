<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AdmissionPopup extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'admission_popups';

    protected $fillable = [
        'title',
        'url',
    ];

    protected $appends = [
        'image',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('admission_popup_image')
            ->singleFile();
    }

    public function getImageAttribute(): ?string
    {
        $media = $this->getFirstMedia(
            'admission_popup_image'
        );

        return $media
            ? $media->getUrl()
            : null;
    }
}