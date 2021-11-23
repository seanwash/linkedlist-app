<script>
    import Link from "../components/Link.svelte";
    import { Inertia } from "@inertiajs/inertia";
    import SidebarNoteSearch from "../components/SidebarNoteSearch.svelte";

    export let auth;
    export let search;

    const user = auth ? auth.user:null;

    let for_date;

    function handleLogout() {
        Inertia.post(window.route("logout"));
    }

    function createDailyNote() {
        for_date = new Date();

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

                <button class="text-xs" on:click={createNote} type="button">
                    New Note
                </button>

                <button class="text-xs" on:click={createDailyNote} type="button">
                    New Daily Note
                </button>
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
