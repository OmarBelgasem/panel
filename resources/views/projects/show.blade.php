@extends('layouts.app')
@section('content')

   <header class="flex items-center mb-3 py-4">
       <div class="flex justify-between items-end w-full">
          <p class="text-gray-gray text-sm font-normal"><a href="/projects"> My Projects </a> / {{ $project->title }} </p>
          <a href="{{ $project->path().'/edit' }}" class="no-underline button"> Edit project </a>
       </div>
    </header>

    <main>
       <div class="lg:flex -mx-3">
           <div class="lg:w-3/4 px-3 mb-6">
           <div class="mb-8">
              <h1 class="text-gray-gray text-lg font-normal mb-3"> Tasks </h1>
                @foreach($project->tasks as $task)
                     <div class="card mb-3">
                        <form method="POST" action="{{ $task->path() }}">
                           @method('PATCH')
                           @csrf
                           <div class="flex items-center">
                              <input name="body" value=" {{ $task->body }} " class="w-full {{ $task->completed ? 'text-gray-gray line-through' : '' }}"/>
                              <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}/>   
                           </div>
                        </form>
                     </div>
                @endforeach
                <div class="card mb-3">
                       <form method="POST" action="{{ $project->path() . '/tasks' }}">
                          @csrf
                             <input class="w-full" placeholder="Begin adding tasks..." name="body"/>
                       </form>
                     </div>
           </div>

           <div class="mb-6">
              <h1 class="text-gray-gray text-lg font-normal mb-3"> General Notes </h1>

              <form method="POST" action="{{ $project->path() }}">
                 @method('PATCH')
                 @csrf
                  <textarea name="notes" class="card w-full mb-4" style="min-height:200px;" placeholder="Anything special that you want to make a note of?">
                     {{ $project->notes }}
                  </textarea>

                  <button type="submit" class="button"> save </button>
              </form>

              @foreach($errors->all() as $error)
                 <li> {{ $error }} </li>
              @endforeach
           </div>

           </div>

           <div class="lg:w-1/4 px-3">
              @include('projects.card')
           </div>
    </main>
@endsection
