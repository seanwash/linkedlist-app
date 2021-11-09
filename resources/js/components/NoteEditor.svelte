<script>
    import { onDestroy, onMount } from "svelte";
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
    if (isTodayNote) { props["id"] = "today" }

    props["class"] = isTodayNote ? 'bg-gradient-to-b from-yellow-50 to-white' : 'bg-white';

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
                Inertia.put(`/n/${note.id}`, { content: editor.getHTML() });
            }, 250),
        });
    });

    onDestroy(() => {
        if (editor) {
            editor.destroy();
        }
    });
</script>

<article {...props}>
    <h3 class="p-8 pb-0 text-2xl font-bold">
        {#if isTodayNote}
            <span class="inline-block mr-1">☀️</span>️
        {/if}
        {note.title}
    </h3>
    <div class="p-8">
        <div bind:this={element} />
    </div>
</article>
