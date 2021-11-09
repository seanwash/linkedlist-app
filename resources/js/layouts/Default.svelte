<script>
    import { page } from "@inertiajs/inertia-svelte";
    import Link from "../components/Link.svelte";
    import { add } from "date-fns";
    import { Inertia } from "@inertiajs/inertia";

    const user = $page.props.auth ? $page.props.auth.user:null;

    $: last_daily_note_at = $page.props.last_daily_note_at;

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

    function scrollToTop() {
        const listContainer = document.getElementById("scrolling-container");
        listContainer.scroll({ top: 0, behavior: "smooth" });
    }
</script>

<div class="min-h-screen flex bg-gray-100">
    <div class="max-w-sm w-full flex flex-col justify-between p-8 bg-gray-100">
        <div>
            <div class="flex items-center justify-between">
                <Link href={window.route('notes.index')}>
                    <span class="flex items-center block h-10 w-auto fill-current text-gray-600">
                      🧬 <span class="inline-block ml-2 text-sm font-semibold text-gray-900">LinkedList</span>
                    </span>
                </Link>

                <button class="text-xs" on:click={createDailyNote} type="button">
                    New Daily Note
                </button>
            </div>

            <div>
                <input class="w-full" placeholder="I don't do anything yet." type="search">
            </div>
        </div>

        <div class="flex items-center justify-between">
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

    <section class="w-full h-screen overflow-y-scroll" id="scrolling-container">
        <slot />
    </section>
</div>
