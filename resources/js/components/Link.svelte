<script>
    import { inertia } from "@inertiajs/inertia-svelte";

    export let href;
    export let type = 'button'
</script>

{#if href}
    <a use:inertia {...$$props} {href}>
        <slot/>
    </a>
{:else}
    <button {...$$props} {type}>
        <slot/>
    </button>
{/if}
