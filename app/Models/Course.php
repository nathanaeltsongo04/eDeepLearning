<?php

namespace App\Models;

use App\Models\Enrollement;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    /**
     * Get the lecturer that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(lecturer::class, 'lecturer_id' );
    }

    /**
     * Get all of the Enrollement for the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Enrollement(): HasMany
    {
        return $this->hasMany(Enrollement::class);
    }

    /**
     * The Student that belong to the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Student(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'Enrollements', 'course_id', 'student_id');
    }
}
