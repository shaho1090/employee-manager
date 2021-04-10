<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'note' => $this->faker->text,
            'time' => $this->faker->time(),
            'status_id' => TaskStatus::toDo()->id,
            'done_at' => Carbon::now()->toDateTimeString(),
            'creator_id' => auth()->check() ? auth()->user()->id : User::factory()
        ];
    }
}
