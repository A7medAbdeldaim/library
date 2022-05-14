<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar', 'name_en', 'description_ar', 'description_en', 'image', 'price', 'stock', 'library_id', 'type'
    ];

    public function getNameAttribute() {
        return $this->attributes['name_en'];
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    public function getImageAttribute(): string
    {
        return Storage::url($this->attributes['image']);
    }
}
