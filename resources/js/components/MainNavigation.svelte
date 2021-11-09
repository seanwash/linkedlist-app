<script>
    import { page } from "@inertiajs/inertia-svelte";
    import Link from "./Link.svelte";
    import { Inertia } from "@inertiajs/inertia";

    const user = $page.props.auth ? $page.props.auth.user:null;

    let userMenuOpen = false;

    function toggleUserMenu() {
        userMenuOpen = !userMenuOpen;
    }

    function handleLogout() {
        Inertia.post(window.route('logout'))
    }
</script>

<nav class="bg-white border-b border-gray-100">
    <!--{/* Primary Navigation Menu */}-->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!--{/* Logo */}-->
                <div class="flex-shrink-0 flex items-center">
                    <Link href={window.route('notes.index')}>
                        <span class="flex items-center block h-10 w-auto fill-current text-gray-600">
                          🧬
                            <span class="inline-block ml-2 text-sm font-semibold text-gray-900">
                            LinkedList
                          </span>
                        </span>
                    </Link>
                </div>

                <!--{/* Navigation Links */}-->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <Link
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out"
                        href={window.route('notes.index')}
                    >
                        Notes
                    </Link>
                </div>
            </div>

            <!--{/* Settings Dropdown */}-->
        </div>
    </div>
</nav>
