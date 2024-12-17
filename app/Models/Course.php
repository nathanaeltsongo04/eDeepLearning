<?php

namespace App\Models;

use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
     * Get all of the Enrollment for the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Enrollment(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * The Student that belong to the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Student(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'Enrollments', 'course_id', 'student_id');
    }

    use HasFactory;

    protected $fillable= ['title', 'lecturer_id', 'description'];
}
