<?php

namespace App\Models;

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
        'creator_id'
    ];

    protected $appends = [
        'status',
    ];

//    protected $casts = [
//        'time' => 'time'
//    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function getStatusAttribute()
    {
        return TaskStatus::where('id',$this->status_id)->first()->title;
    }

    /**
     * @throws \Exception
     */
    public function createNew($request)
    {
        return $this->create([
            'name' => $request['name'],
            'note' => $request['note'],
            'time' => Carbon::parse((int)($request['time']))->toTimeString(),
            'status_id' => TaskStatus::toDo()->id,
            'creator_id' => auth()->user()->id,
            ]);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'creator_id');
    }

    /**
     * @throws Exception
     */
    public function assignTo(User $user)
    {
        if($this->isAssigned()){
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
        $this->users()->detach($user);

        $this->update([
            'status_id' => TaskStatus::toDo()->id
        ]);

        $this->refresh();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function isAssigned()
    {
        return $this->users()->first();
    }
}
