<script>
    import Link from "../components/Link.svelte";
    import { Inertia } from "@inertiajs/inertia";
    import SidebarNoteSearch from "../components/SidebarNoteSearch.svelte";
    import { add } from "date-fns";

    export let last_daily_note_at;
    export let auth;
    export let search;

    const user = auth ? auth.user:null;
    const sharedButtonClasses = "flex items-center text-xs text-gray-700 font-bold bg-white py-2 pl-2 pr-4 ";

    let for_date;

    function handleLogout() {
        Inertia.post(window.route("logout"));
    }

    function createDailyNote() {
        if (last_daily_note_at) {
            for_date = add(new Date(last_daily_note_at), { days: 1 });
        } else {
            for_date = new Date();
        }

        Inertia.post(window.route("notes.store"), {
            title: for_date.toLocaleDateString(),
            for_date,
        }, {
            onFinish: () => scrollToTop(),
        });
    }

    function createNote() {
        Inertia.post(window.route("notes.store"), {
            title: "Untitled",
        });
    }

    function scrollToTop() {
        const listContainer = document.getElementById("scrolling-container");
        listContainer.scroll({ top: 0, behavior: "smooth" });
    }
</script>

<div class="h-screen overflow-y-scroll flex bg-gray-100">
    <!-- Sidebar -->
    <div class="max-w-sm w-full flex flex-col justify-between bg-gray-100">
        <div class="flex flex-col min-h-0">

            <!-- Logo & Nav -->
            <div class="flex items-center justify-between p-4 pb-2">
                <Link href={window.route('notes.index')}>
                    <span class="flex items-center block h-10 w-auto fill-current text-gray-600">
                      🧬 <span class="inline-block ml-2 text-sm font-semibold text-gray-900">LinkedList</span>
                    </span>
                </Link>

                <div class="flex items-center">
                    <button class={`${sharedButtonClasses} rounded-l-lg`} on:click={createNote} type="button">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                  fill-rule="evenodd" />
                        </svg>
                        Note
                    </button>

                    <button class={`${sharedButtonClasses} rounded-r-lg border-l`} on:click={createDailyNote}
                            type="button">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                  fill-rule="evenodd" />
                        </svg>
                        Daily Note
                    </button>
                </div>
            </div>

            <!-- Search & Results -->
            <SidebarNoteSearch {search} />
        </div>

        <!-- Footer -->
        <div class="flex items-center justify-between p-4">
            <span class="block text-sm">{user?.email}</span>

            <button
                class="block text-sm appearance-none text-gray-700 focus:outline-none"
                on:click={handleLogout}
                type="button"
            >
                Log Out
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <section class="w-full h-screen overflow-y-scroll" id="scrolling-container">
        <slot />
    </section>
</div>
