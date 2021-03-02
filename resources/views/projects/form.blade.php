        @csrf
            <div class="field mb-12">
                <label class="label text-gray-gray" for="title"> Title </label>

                <div class="control m-2">
                    <input type="text" value="{{ $project->title }}" class="input outline-none focus:ring rounded w-full border-2" name="title" placeholder="Title" required>
                </div>
            </div>

            <div class="field">
                <label class="label text-gray-gray" for="description"> Description </label>

                <div class="control m-2">
                    <textarea class="textarea outline-none focus:ring rounded w-full border-2 h-32" name="description" placeholder="Description" required>{{ $project->description }}</textarea>
                </div>
            </div>

            <div class="field">

                <div class="control">
                    <button type="submit" class="button mr-2">{{ $buttonText }}</button>
                    <a href="{{ $project->path() }}" class="button-is-link"> Cancel </a>
                </div>
            </div>

            @if($errors->any())
                <div class="field mt-6">
                    @foreach($errors->all() as $error)
                        <li class="text-sm text-red-600">{{ $error }}</li>
                    @endforeach
                </div>
            @endif
