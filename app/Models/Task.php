<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'assigned_by_id', 'assigned_to_id'];

    public function scopeICreated(Builder $builder) :void
    {
        $builder->where('assigned_by_id', request()->user()->id);
    }

    public function scopeAssignedToMe(Builder $builder, $request) :void
    {
        $builder->where('assigned_to_id', $request->user()->id);
    }


    public function creator() :BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }


}
