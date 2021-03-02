<div class="card">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-blue pl-4"><a href="{{ $project->path() }}"> {{ $project->title }} </a></h3>
    <div class="text-gray-gray">
        {{ $project->description, 100 }}
    </div>
</div>