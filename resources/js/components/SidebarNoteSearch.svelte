<script>
    import { debounce } from "lodash";
    import { Inertia } from "@inertiajs/inertia";
    import Link from "./Link.svelte";
    import { useForm } from "@inertiajs/inertia-svelte";

    export let search;

    const deleteForm = useForm();

    const handleSearch = debounce(() => {
        Inertia.get(window.route("notes.index"), {
            s: search.query,
        }, {
            preserveState: true,
            replace: true,
        });
    }, 500);

    function deleteNote(noteUuid) {
        $deleteForm.delete(window.route("notes.delete", noteUuid));
    }
</script>

<!-- Search Input-->
<div class="p-4 pt-2">
    <input
        aria-label="Search Your Notes"
        bind:value={search.query}
        class="w-full"
        on:input={handleSearch}
        placeholder="Search" type="search"
    >
</div>

<!-- Note List -->
<div class="overflow-y-scroll px-4">
    <ul class="space-y-2">
        {#if search.notes?.length}
            {#each search.notes as note (note.id)}
                <li class="flex items-center bg-white rounded-sm">
                    <Link class="block w-full pl-4 py-2 text-sm"
                          href={window.route('notes.show', note.uuid)}
                    >{note.title}</Link>

                    <button
                        type="button" on:click|preventDefault={() => deleteNote(note.uuid)}
                        class="px-4 py-2 text-gray-300"
                        disabled={$deleteForm.processing}
                    >
                        <span class="sr-only">Delete</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </li>
            {/each}
        {/if}
    </ul>
</div>
