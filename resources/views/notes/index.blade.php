<x-app-layout>
    <livewire:offline-warning-banner />

    <div class="pt-8 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4 px-4 sm:p-0">
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
