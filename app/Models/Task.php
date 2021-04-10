<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'note',
        'time',
        'status_id',
        'done_at',
        'creator_id'
    ];

    protected $appends = [
        'status',
        'owner'
    ];

    public function getStatusAttribute()
    {
        return TaskStatus::where('id', $this->status_id)->first()->title;
    }

    public function getOwnerAttribute()
    {
        return $this->owner()->first()->name;
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    /**
     * @param $request
     * @throws Exception
     */
    public function createNew($request)
    {
        $task = $this->create([
            'name' => $request['name'],
            'note' => $request['note'],
            'time' => Carbon::parse((int)($request['time']))->toTimeString(),
            'status_id' => TaskStatus::toDo()->id,
            'creator_id' => auth()->user()->id,
        ]);

        if(!auth()->user()->isAdmin()){
            $task->assignTo(auth()->user());
        }
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * @param User $user
     * @throws Exception
     */
    public function assignTo(User $user)
    {
        if ($this->isAssigned()) {
            throw new Exception('This task already assigned!');
        }

        $this->users()->attach($user);

        $this->update([
            'status_id' => TaskStatus::inProgress()->id
        ]);

        $this->refresh();
    }

    public function unassignFrom(User $user)
    {
        if ($this->isInProgress()) {
            $this->users()->detach($user);

            $this->update([
                'status_id' => TaskStatus::toDo()->id
            ]);

            $this->refresh();
        }
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function isAssigned()
    {
        return $this->users()->first();
    }

    public function isAssignedTo(User $employee)
    {
        return $this->users()->where('user_id', $employee->id)->first();
    }

    public function isInProgress(): bool
    {
        if ((int)$this->status_id === (int)TaskStatus::inProgress()->id) {
            return true;
        }

        return false;
    }

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
