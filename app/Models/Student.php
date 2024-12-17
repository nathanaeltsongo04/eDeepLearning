<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    // Ajoutez les champs autorisés pour l'assignation de masse
    protected $fillable = ['name', 'email', 'age','country', 'birth_date']; // Ajoutez d'autres champs si nécessaire
    /**
     * The Course that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Course(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'Enrollments', 'student_id', 'course_id');
    }

    /**
     * Get all of the Enrollment for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Enrollment(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }
}
