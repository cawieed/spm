<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Progress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'progress_id',
        'status',
        'date',
        'description'
        // Add other attributes here
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
