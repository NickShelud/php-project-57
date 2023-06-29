<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Label extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function creator(): belongTo
    {
        return $this->belongTo(User::class);
    }

    public function task(): hasMany
    {
        return $this->hasMany(Tasks::class);
    }
}
