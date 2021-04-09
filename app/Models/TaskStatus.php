<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class TaskStatus extends Model
{
    use HasFactory;

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * @throws Exception
     */
    public static function toDo()
    {
        if(! $toDo = self::where('title','to-do')->first()){
            throw new Exception('It seems "To Do status" was not inserted!');
        }

        return $toDo;
    }

    /**
     * @throws Exception
     */
    public static function inProgress()
    {
        if(! $inProgress = self::where('title','in-progress')->first()){
            throw new Exception('It seems "In progress status" was not inserted!');
        }

        return $inProgress;
    }

    /**
     * @throws Exception
     */
    public static function done()
    {
        if(! $done = self::where('title','done')->first()){
            throw new Exception('It seems "done" status was not inserted!');
        }

        return $done;
    }

}
