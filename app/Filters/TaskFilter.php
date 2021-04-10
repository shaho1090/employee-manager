<?php


namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends QueryFilter
{

    public function doneDate($date)
    {
        if(!is_null($date)){
           return $this->builder->whereDate('done_at', '=',Carbon::parse($date)->toDateString());
        }
    }
}
