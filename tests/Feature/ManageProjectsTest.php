<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use App\Project;

class ManageProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */

    public function guests_cannot_manage_projects() {

        // $this->withoutExceptionHandling();
        
        $project= factory('App\Project')->create();

        // $project = $this->signIn();

        
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path().'/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    // /** @test */

    // public function guests_cannot_view_projects() {


    //     $this->get('/projects')->assertRedirect('login');
    // }

    // /** @test */

    // public function guests_cannot_view_a_single_project() {


    //     $this->get($project->path())->assertRedirect('login');
    // }

    /** @test */

    public function a_user_can_create_a_project () {
        $this->withoutExceptionHandling();

        // $this->actingAs(factory('App\User')->create());

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'Genral notes here.'
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();
        
        $response->assertRedirect($project->path());

        // $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
        ->assertSee($attributes['title'])
        ->assertSee($attributes['description'])
        ->assertSee($attributes['notes']);
    }

    /** @test */

    public function a_user_can_update_a_project() {
        // $this->signIn();

        // $this->withoutExceptionHandling();

        // $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->patch($project->path(), $attributes = [
            'title' => 'Changed', 'description' =>'Changed', 'notes' => 'Changed'
        ])->assertRedirect($project->path());

        $this->get($project->path().'/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */

    public function a_user_can_update_a_projects_general_notes() {
        // $this->signIn();

        // $this->withoutExceptionHandling();

        // $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->patch($project->path(), $attributes = [
            'notes' => 'Changed'
        ]);

        $this->assertDatabaseHas('projects', $attributes);
    } 

    /** @test */

    public function a_project_requires_a_title() {

        // $this->actingAs(factory('App\User')->create());

        $this->signIn();

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */

    public function a_user_can_view_their_project() {

        // $this->be(factory('App\User')->create());

        // $this->signIn();

        $this->withoutExceptionHandling();

        // $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
        
        //or this

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->get($project->path())->assertSee($project->title)->assertSee($project->description);
    }

    /** @test */

    public function an_authenticated_user_cannot_view_the_projects_of_others() {
        // $this->be(factory('App\User')->create());

        $this->signIn();

        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */

    public function an_authenticated_user_cannot_update_the_projects_of_others() {
        // $this->be(factory('App\User')->create());

        $this->signIn();

        $project = factory('App\Project')->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }

    /** @test */

    public function a_project_requires_a_description() {

        // $this->actingAs(factory('App\User')->create());
        
        $this->signIn();

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
