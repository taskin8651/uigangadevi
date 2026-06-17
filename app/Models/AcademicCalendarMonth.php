<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCalendarMonth extends Model
{
    use HasFactory;

    protected $table = 'academic_calendar_months';

    protected $fillable = [
        'academic_calendar_id',
        'month_name',
        'month_value',
        'display_number',
        'activities',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'month_value' => 'integer',
        'display_number' => 'integer',
        'activities' => 'array',
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];

    public function academicCalendar()
    {
        return $this->belongsTo(
            AcademicCalendar::class
        );
    }
}