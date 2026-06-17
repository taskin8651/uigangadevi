<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WebsiteSetting extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_url',
        'footer_description',
        'copyright_text',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'address_line',
        'city',
        'state',
        'country',
        'postal_code',
        'primary_email',
        'admission_email',
        'exam_email',
        'documents_email',
        'primary_phone',
        'admission_phone',
        'exam_phone',
        'documents_phone',
        'office_days',
        'office_time',
        'calling_hours',
        'closed_days',
        'map_embed_url',
        'map_link',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'linkedin_url',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $appends = [
        'logo',
        'favicon',
        'full_address',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], static::defaults());
    }

    public static function defaults(): array
    {
        return [
            'site_name' => 'Ganga Devi Mahila Mahavidyalaya',
            'site_tagline' => 'Official College Website | gdmm.ac.in',
            'site_url' => 'https://gdmm.ac.in',
            'footer_description' => 'Official college website for academic information, notices, admission updates, statutory disclosures and student support services.',
            'copyright_text' => 'Copyright 2026 Ganga Devi Mahila Mahavidyalaya. All Rights Reserved.',
            'meta_title' => 'Ganga Devi Mahila Mahavidyalaya | Official College Website',
            'meta_description' => 'Official website of Ganga Devi Mahila Mahavidyalaya, Patna.',
            'address_line' => 'Kankarbagh',
            'city' => 'Patna',
            'state' => 'Bihar',
            'country' => 'India',
            'primary_email' => 'gangadevimahilacollege@gmail.com',
            'primary_phone' => '+91 XXXXX XXXXX',
            'office_days' => 'Monday to Saturday',
            'office_time' => '10:00 AM - 5:00 PM',
            'calling_hours' => 'During official college working hours',
            'closed_days' => 'Sunday and notified holidays',
            'status' => true,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('website_logo')
            ->singleFile();

        $this
            ->addMediaCollection('website_favicon')
            ->singleFile();
    }

    public function getLogoAttribute(): ?string
    {
        $media = $this->getFirstMedia('website_logo');

        return $media ? $media->getUrl() : null;
    }

    public function getFaviconAttribute(): ?string
    {
        $media = $this->getFirstMedia('website_favicon');

        return $media ? $media->getUrl() : null;
    }

    public function getFullAddressAttribute(): string
    {
        return collect([
            $this->address_line,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country,
        ])
            ->filter()
            ->implode(', ');
    }
}
