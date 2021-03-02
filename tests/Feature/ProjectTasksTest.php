<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use App\Project;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects() {
        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks() {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks', ['body' => 'Task test'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Task test']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_task() {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        // $project = factory('App\Project')->create();

        // $task = $project->addTask('Test task');

        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changes']);
    }

    /** @test */
    public function a_project_can_have_tasks() {

        // $this->signIn();

        // $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        //or this

        // $project = factory(Project::class)->raw();

        // $project = auth()->user()->projects()->create($project);

        //or this

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated() {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::withTasks(1)->create();
        // $this->signIn();

        // $project = factory(Project::class)->create(['owner_id' => auth()->id()]);
        //or this

        // $project = factory(Project::class)->raw();

        // $project = auth()->user()->projects()->create($project);

        // $task = $project->addTask('Test task');

        $this->actingAs($project->owner)->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
    ]);
    }

    /** @test */
    public function a_task_require_a_body() {
        // $this->signIn();

        // $project = factory(Project::class)->raw();

        // $project = auth()->user()->projects()->create($project);

        $project = ProjectFactory::create();

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->actingAs($project->owner)->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
