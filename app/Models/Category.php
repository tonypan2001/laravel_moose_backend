<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['categoryName'];

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Set Time Format
    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->format('Y/m/d - H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d - H:i:s');
    }
}
