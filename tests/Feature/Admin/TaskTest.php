<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\AdminSeeder;
use Database\Seeders\EmployeeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    public function setUp(): void
    {
        parent::setUp();

        (new AdminSeeder)->run();
        (new EmployeeSeeder)->run();
        $this->admin = User::where('email','admin@gmail.com')->first();
    }

    public function test_we_have_already_an_admin_user_in_database()
    {
        $this->assertTrue($this->admin->isAdmin());
    }

    public function test_we_have_already_three_employee()
    {
        $employees = Role::employee()->first()->users()->get();

        $this->assertEquals(3,  $employees->count());
    }

    /**
     * @throws \Exception
     */
    public function test_the_admin_can_store_new_task()
    {
        $this->withoutExceptionHandling();

        $this->be($this->admin);

        $this->assertAuthenticatedAs($this->admin);

        $taskData = [
            'name' => 'task example name',
            'note' => 'description for the task',
            'time' => 14,
        ];

        $this->post(route('task.store'),$taskData);

        $this->assertDatabaseHas('tasks',[
            'name' => $taskData['name'],
            'note' => $taskData['note'],
            'time' => Carbon::parse($taskData['time'])->toTimeString(),
            'status_id' =>  TasKStatus::ToDo()->id,
            'creator_id' => $this->admin->id
        ]);
    }

    public function test_the_admin_can_see_all_tasks()
    {
        $this->withoutExceptionHandling();

        $this->be($this->admin);

        $tasks = Task::factory(3)->create()->toArray();

        $this->get(route('admin.task.index'))->assertSee([
            'name' => $tasks[0]['name'],
        ])->assertSee([
            'name' => $tasks[1]['name'],
        ])->assertSee([
            'name' => $tasks[2]['name'],
        ]);
    }



}
