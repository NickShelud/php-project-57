<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatuses extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): hasMany
    {
        return $this->hasMany(Tasks::class);
    }

    public function scopeStatusNameById($query, $id)
    {
        return $query->where('id', $id)->pluck('name');
    }
}
