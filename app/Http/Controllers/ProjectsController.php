<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;

class ProjectsController extends Controller
{
    public function index() {
        $projects = auth()->user()->projects;

    return view('projects.index', compact('projects'));
    }

    public function show(Project $project) {
        $this->authorize('update', $project);
        // if(auth()->user()->isNot($project->owner)) {
        //     abort(403);
        // }

    return view('projects.show', compact('project'));
    }

    public function store() {

        $attributes = $this->validateRequest();

            $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }

    public function edit(Project $project) {
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request) {
        // $this->authorize('update', $project);
        // if(auth()->user()->isNot($project->owner)) {
        //     abort(403);
        // }

        // $attributes = $this->validateRequest();

        // $project->update($request->validated());
        $request->persist();

        return redirect($request->save()->path());
    }

    public function create(Project $project) {
        return view('projects.create', compact('project'));
    }

    /**
     * @return array
     */
    protected function validateRequest() {
        $attributes = request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);

        return $attributes;
    }
}
