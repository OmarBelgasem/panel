@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
       <div class="flex justify-between items-end w-full">
          <h1 class="text-gray-gray text-sm font-normal"> My Projects </h1>
          <a href="/projects/create" class="no-underline button"> New Project </a>
       </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
      @forelse($projects as $project)
        <div class="lg:w-1/3 px-3 pb-2">
         @include('projects.card')
        </div>
      @empty
            <div> No projects yet </div>
      @endforelse
    </main>
@endsection
