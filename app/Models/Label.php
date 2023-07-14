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

    public function creator(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): hasMany
    {
        return $this->hasMany(Tasks::class);
    }

    public function scopeLabelNameById(mixed $query, mixed $id)
    {
        return $query->where('id', $id)->pluck('name');
    }
}
