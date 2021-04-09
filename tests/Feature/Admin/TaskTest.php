<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
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

        $this->post(route('task.store'),$taskData)->dump();

        $this->assertDatabaseHas('tasks',[
            'name' => $taskData['name'],
            'note' => $taskData['note'],
            'time' => Carbon::parse($taskData['time'])->toTimeString(),
            'status_id' =>  TasKStatus::ToDo()->id
        ]);
    }


}
