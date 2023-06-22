<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status_id', 'created_by_id', 'assigned_to_id'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatuses::class);
    }
}
