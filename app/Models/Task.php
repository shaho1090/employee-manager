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
        'status_id'
    ];

//    protected $casts = [
//        'time' => 'time'
//    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    /**
     * @throws \Exception
     */
    public function createNew($request)
    {
        return $this->create([
            'name' => $request['name'],
            'note' => $request['note'],
            'time' => Carbon::parse($request['time'])->toTimeString(),
            'status_id' => TaskStatus::toDo()->id
            ]);
    }
}
