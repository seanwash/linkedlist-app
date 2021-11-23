<script>
    import { debounce } from "lodash";
    import { Inertia } from "@inertiajs/inertia";
    import Link from "./Link.svelte";

    export let search;

    const handleSearch = debounce(() => {
        Inertia.get(window.route("notes.index"), {
            s: search.query,
        }, {
            preserveState: true,
            replace: true,
        });
    }, 500);
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
                <li>
                    <Link class="block p-2 bg-white rounded-sm text-sm"
                          href={window.route('notes.show', note.uuid)}
                    >{note.title}</Link>
                </li>
            {/each}
        {/if}
    </ul>
</div>
