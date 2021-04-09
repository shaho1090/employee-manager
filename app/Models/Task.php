<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
//        dd($request['time']);
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
}
