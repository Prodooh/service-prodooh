<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $hidden = ['imageable_type'];

    protected $casts = [
        'multiplier' => 'double'
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::uuid()->toString();
        });
    }

    // ************
    //   Eloquent
    // ************

    /**
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get all countries for the company.
     */
    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class)->withTimestamps();
    }
}
