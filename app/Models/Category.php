<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function scopePopular(Builder $query) {
        $query->withCount('events')->orderByDesc('events_count')->limit(5);
    }
}
