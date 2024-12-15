<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Enrollement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    /**
     * The Course that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Course(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'Enrollements', 'student_id', 'course_id');
    }

    /**
     * Get all of the Enrollement for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Enrollement(): HasMany
    {
        return $this->hasMany(Enrollement::class, 'student_id');
    }
}
