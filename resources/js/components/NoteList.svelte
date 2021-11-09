<script>
    import { page } from "@inertiajs/inertia-svelte";
    import NoteEditor from "./NoteEditor.svelte";

    $: notes = $page.props.notes;

    function scrollToToday() {
        const todayEl = document.getElementById("today");

        if (todayEl) {
            const todayElOffset = todayEl.offsetTop;
            const listContainer = document.getElementById("scrolling-container");
            listContainer.scroll({ top: todayElOffset, behavior: "smooth" });
        }
    }
</script>

<div class="overflow-hidden relative">
    {#if notes}
        <a
            on:click|preventDefault={scrollToToday}
            class="fixed z-10 top-3 right-3 font-semibold text-xs"
            href="#today"
        >
            <span class="inline-block mr-1">☀️</span> Today's Note
        </a>
    {/if}

    <div class="divide-y divide-gray-200">
        {#each notes as note (note.id)}
            <NoteEditor {note} />
        {:else}
            <div class="p-4 bg-white">
                There's no time like the present!
            </div>
        {/each}
    </div>
</div>
