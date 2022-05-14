<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conversation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function teacher_messages(): HasMany
    {
        return $this->hasMany(TeacherMessage::class);
    }

    public function user_messages(): HasMany
    {
        return $this->hasMany(StudentMessage::class);
    }

    public function user_last_message(): HasOne
    {
        return $this->hasOne(StudentMessage::class)->latest();
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getLastMessageAttribute()
    {
        if (auth('users')->check()) {
            $message = StudentMessage::where('conversation_id', $this->attributes['id'])->first();
            return $message ? $message->message : null;
        }
        return null;
    }
}
