<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Notes</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <form method="POST" action="{{ route('notes.daily.store') }}">
                    @csrf
                    <button type="submit">
                        <span class="inline-block mr-2">📝</span> New Note
                    </button>
                </form>

                <a href="#today">
                    <span class="inline-block mr-2">👉</span>
                    Today's Note
                </a>
            </div>

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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                @forelse ($notes as $note)
                    <livewire:note-editor :note="$note"/>
                @empty
                    <p class="p-4 text-sm text-gray-600">You don't have any notes yet. Give the button above a good
                        slap.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
