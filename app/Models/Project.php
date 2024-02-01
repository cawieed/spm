<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Project extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'project_id',
        'title',
        'type',
        'is_approved',
        'description',
        'status',
        'duration',
        'start_date',
        'end_date',
        'owner_id',
        'lead_developer_id',
        'methodology',
        'platform',
        'deployment'
        // Add other attributes here
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }

    public function leadDeveloper(): BelongsTo
    {
        return $this->belongsTo(LeadDeveloper::class);
    }



    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Developer::class, 'developer_project', 'project_id', 'developer_id');
    }


    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
