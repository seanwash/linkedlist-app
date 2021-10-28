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
                    {{--
                    TODO: This is a hack to get around tailwind-custom-forms applying
                          focus styles to all textareas.
                    --}}
                    @push('styles')
                        <style>
                            textarea:focus {
                                border: none !important;
                                outline: none !important;
                                box-shadow: none !important;
                            }
                        </style>
                    @endpush

                    @foreach($notes as $note)
                        <article id="{{ $note->uuid }}" class="py-4 px-2">
                            <h1 class="text-xl font-semibold">{{ $note->title }}</h1>

                            <form
                                id="{{ $note->uuid }}"
                                method="POST"
                                action="{{ route('notes.update', $note->uuid) }}"
                            >
                                @csrf
                                @method('PUT')
                                <label for="content" class="sr-only">Content</label>
                                <textarea
                                    aria-label="Content"
                                    name="content"
                                    class=" mt-2 border-none p-0 w-full"
                                    style="min-height: 600px;"
                                >{{ $note->content }}</textarea>

                                @error('title', 'content')
                                <div>{{ $message }}</div>
                                @enderror
                            </form>
                        </article>
                    @endforeach

                    @push('scripts')
                        <script>
                            let textAreaEls = document.querySelectorAll('textarea');

                            if (textAreaEls.length) {
                                textAreaEls.forEach(function (textAreaEl) {
                                    textAreaEl.addEventListener('blur', function (event) {
                                        this.closest('form').submit();
                                    });
                                })
                            }
                        </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
