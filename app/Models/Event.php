<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Avis as AppComment; // Alias the Comment class

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'capacity',
        'price',
        'image'
    ];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeUpcoming(Builder $query): void {
        $query->where('start_date', '<=', now())->orderBy('start_date', 'asc')->limit(5);
    }

    public function participate()
    {
        return $this->belongsToMany(User::class,  'participants');
    }

    public function comment()
    {
        return $this->hasMany(AppComment::class); // Use the alias
    }
}
