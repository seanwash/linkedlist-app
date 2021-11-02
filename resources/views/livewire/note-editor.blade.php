<article
    @if($for_today) id="today" @endif
    class="p-6 bg-white border-b border-gray-200"
    x-data="setupEditor(@entangle('note.content').defer)"
    x-init="() => init($refs.editor)"
    wire:ignore
    wire:keydown.debounce.2s="save"
>
    <h1 class="text-2xl font-semibold">
        @if($for_today)
            <span class="inline-block mr-1">👉</span>
        @endif
        {{ $note->title }}
    </h1>

    @once
        @push('styles')
            {{--
            TODO: This is a hack to get around tailwind-custom-forms applying
                  focus styles to all textareas.
            --}}
            <style>
                .ProseMirror {
                    min-height: 600px;
                }
            </style>
        @endpush
    @endonce

    <div
        x-ref="editor"
        class="mt-4 focus:outline-none"
    ></div>
</article>
