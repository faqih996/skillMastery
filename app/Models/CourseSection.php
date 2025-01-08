<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CourseSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'course_id',
        'position',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function sectionContent(): HasMany
    {
        return $this->hasMany(sectionContent::class);
    }
}
