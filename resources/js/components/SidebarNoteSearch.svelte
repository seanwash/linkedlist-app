<script>
    import { debounce } from "lodash";
    import { Inertia } from "@inertiajs/inertia";
    import { fade } from "svelte/transition";
    import Link from "./Link.svelte";
    import { useForm } from "@inertiajs/inertia-svelte";

    export let search;

    const fadeTransitionAgs = {
        delay: 0,
        duration: 140,
    };

    const deleteForm = useForm();

    const handleSearch = debounce(() => {
        Inertia.get(window.route("notes.index"), {
            s: search.query,
        }, {
            replace: true,
        });
    }, 500);

    function resetSearchQuery() {
        search.query = null;
        handleSearch();
    }

    function deleteNote(noteUuid) {
        $deleteForm.delete(window.route("notes.delete", noteUuid));
    }

    function handleKeydown(event) {
        if (event.metaKey && event.code==="KeyK") {
            document.getElementById("searchInput").focus();
        }
    }
</script>

<svelte:window on:keydown={handleKeydown} />

<!-- Search Input-->
<div class="p-4 pt-2">
    <div
        class={`flex items-center bg-white rounded-sm overflow-hidden transition-all duration-${fadeTransitionAgs.duration} focus-within:ring-2 focus-within:ring-black`}>
        <div class="px-3 h-11 flex items-center text-gray-400">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      fill-rule="evenodd" />
            </svg>
        </div>

        <input
            aria-label="Search Notes"
            bind:value={search.query}
            class="w-full border-none appearance-none p-0 h-11 focus:ring-0"
            id="searchInput"
            on:input={handleSearch}
            placeholder="Search Notes"
            type="text"
        >

        {#if search.query}
            <div transition:fade|local={fadeTransitionAgs} class="h-11 p-3">
                <button on:click={resetSearchQuery}
                        class={`appearance-none rounded-sm transition-all duration-${fadeTransitionAgs.duration} ring-2 ring-transparent outline-none focus:outline-none focus:ring-black`}
                        type="button"
                >
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              fill-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Clear Search Query</span>
                </button>
            </div>
        {/if}
    </div>
</div>

<!-- Note List -->
<div class="overflow-y-scroll px-4">
    <ul class="space-y-2">
        {#if search.notes?.length}
            {#each search.notes as note (note.id)}
                <li class="flex items-center bg-white rounded-sm overflow-hidden ring-inset ring-2 ring-transparent transition-all duration-${fadeTransitionAgs.duration} focus-within:ring-black">
                    <Link class="block w-full pl-4 py-2 text-sm ring-0 outline-none"
                          href={window.route('notes.show', { note: note.uuid, s: search.query })}
                    >{note.title}</Link>

                    <div class="px-3 py-2 text-gray-300 flex items-center">
                        <button
                            type="button" on:click|preventDefault={() => deleteNote(note.uuid)}
                            class={`rounded-sm transition-all duration-${fadeTransitionAgs.duration} ring-2 ring-transparent outline-none focus:text-black focus:outline-none focus:ring-black`}
                            disabled={$deleteForm.processing}
                        >
                            <span class="sr-only">Delete</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </li>
            {/each}
        {/if}
    </ul>
</div>
