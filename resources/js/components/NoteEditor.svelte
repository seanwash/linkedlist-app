<script>
    import { afterUpdate, onDestroy, onMount } from "svelte";
    import { Editor } from "@tiptap/core";
    import StarterKit from "@tiptap/starter-kit";
    import TaskList from "@tiptap/extension-task-list";
    import TaskItem from "@tiptap/extension-task-item";
    import Typography from "@tiptap/extension-typography";
    import { debounce } from "lodash";
    import { Inertia } from "@inertiajs/inertia";
    import { isToday, parseISO } from "date-fns";

    export let note;

    let element;
    let editor;
    let timer;
    let props = {};

    const isTodayNote = isToday(parseISO(note.for_date));
    if (isTodayNote) {
        props["id"] = "today";
    }

    props["class"] = isTodayNote ? "bg-gradient-to-b from-yellow-50 to-white":"bg-white";
    props["class"] += " min-h-screen";

    function updateTitle() {
        Inertia.put(`/n/${note.uuid}`, { title: note.title, content: note.content });
    }

    onMount(() => {
        editor = new Editor({
            element: element,
            extensions: [StarterKit, TaskList, TaskItem, Typography],
            content: note.content,
            onTransaction: () => {
                // force re-render so `editor.isActive` works as expected
                editor = editor;
            },
            onUpdate: debounce(({ editor }) => {
                Inertia.put(`/n/${note.uuid}`, {
                    title: note.title,
                    content: editor.getHTML(),
                });
            }, 2000),
        });
    });

    afterUpdate(() => {
        if (note.content !== editor.getHTML()) {
            editor.commands.setContent(note.content);
        }
    });

    onDestroy(() => {
        if (editor) {
            editor.destroy();
        }
    });
</script>

<article {...props}>
    <div class="p-8 pb-0">
        <header class="flex items-center">
            {#if isTodayNote}
                <span class="inline-block mr-4">☀️</span>️
            {/if}
            <input
                bind:value={note.title}
                class="bg-transparent border-none p-0 text-2xl font-bold w-full"
                disabled={!!note.for_date}
                on:change={updateTitle}
                type="text"
            >
        </header>
    </div>
    <div class="p-8">
        <div bind:this={element} />
    </div>
</article>
