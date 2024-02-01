<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Developer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'developer_project', 'developer_id', 'project_id');
    }


    public function leadDeveloper(): HasOne
    {
        return $this->hasOne(LeadDeveloper::class);
    }
}
