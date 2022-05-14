<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherMessage extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'message'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
