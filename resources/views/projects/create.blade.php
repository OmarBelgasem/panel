@extends('layouts.app')
@section('content')
        <div class="flex justify-center items-center">
            <div class="flex justify-center items-center bg-white rounded w-3/4 py-20 shadow">
                <div class="w-3/4">
                    <h1 class="text-2xl font-normal mb-10 text-center"> Creat your Project </h1>
                        <form method="POST" action="{{ $project->path() }}">
                            @include('projects.form', [
                            'project' => new App\Project,
                            'buttonText' => 'Create Project'
                            ])
                        </form>
                </div>
            </div>
        </div>
@endsection