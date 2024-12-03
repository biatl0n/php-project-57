<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;
use App\Models\TaskStatus;

class TaskStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        TaskStatus::factory()->count(2)->make();
    }

    public function testIndex(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testCreateWithAuth()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('task_statuses.create'));
        $response->assertStatus(200);
    }

    public function testCreateWithoutAuth()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertRedirect('login');
    }

    public function testEditWithAuth()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($user)->get(route('task_statuses.edit', [$taskStatus]));
        $response->assertStatus(200);
    }

    public function testEditWithoutAuth()
    {
        $taskStatus =  TaskStatus::factory()->create();
        $response = $this->get(route('task_statuses.edit', [$taskStatus]));
        $response->assertRedirect('login');
    }

    public function testStoreWithAuth()
    {
        $data =  TaskStatus::factory()->make()->only('name');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('task_statuses.store'), $data);
        $response->assertRedirect(route('task_statuses.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testStoreWithoutAuth()
    {
        $data =  TaskStatus::factory()->make()->only('name');
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertRedirect(route('login'));
    }

    public function testUpdateWithAuth()
    {
        $taskStatus = TaskStatus::factory()->create();
        $data = TaskStatus::factory()->make()->only('name');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch(route('task_statuses.update', [$taskStatus]), $data);
        $response->assertRedirect(route('task_statuses.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdateWithoutAuth()
    {
        $taskStatus = TaskStatus::factory()->create();
        $data = TaskStatus::factory()->make()->only('name');

        $response = $this->patch(route('task_statuses.update', [$taskStatus]), $data);
        $response->assertRedirect(route('login'));
    }

    public function testDestroyWithAuth()
    {
        $taskStatus = TaskStatus::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('task_statuses.destroy', [$taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing('task_statuses', $taskStatus->only('id'));
    }

    public  function testDestroyWithoutAuth()
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->delete(route('task_statuses.destroy', [$taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('task_statuses', $taskStatus->only('name'));
    }

}
