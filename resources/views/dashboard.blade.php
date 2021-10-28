<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($notes as $note)
                        <article id="{{ $note->uuid }}" class="py-4 px-2">
                            <h1 class="text-xl">{{ $note->title }}</h1>

                            <form
                                @keyup.meta.enter="alert('Submitted!')"
                                method="POST"
                                action="{{ route('notes.update', $note->uuid) }}"
                            >
                                @csrf
                                @method('PUT')
                                <label for="content" class="sr-only">Content</label>
                                <textarea
                                    id="content"
                                    name="content"
                                    class="mt-2 w-full"
                                    style="min-height: 300px;"
                                >{{ $note->content }}</textarea>
                                @error('title', 'content')
                                <div>{{ $message }}</div>
                                @enderror

                                <input type="submit" value="Update">
                            </form>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
