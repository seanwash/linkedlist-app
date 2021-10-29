<article
    @if($for_today) id="today" @endif
    class="p-6 bg-white border-b border-gray-200"
>
    <h1 class="text-2xl font-semibold">
        @if($for_today)
            <span class="inline-block mr-1">👉</span>
        @endif
        {{ $note->title }}
    </h1>

    <form
        class="mt-4 "
        wire:submit.prevent="save"
    >
        @csrf
        @method('PUT')
        <label for="content" class="sr-only">Content</label>
        <textarea
            aria-label="Content"
            class="border-none p-0 w-full"
            style="min-height: 600px;"
            wire:model="note.content"
            wire:keydown.debounce.2s="save"
        ></textarea>

    </form>
</article>
