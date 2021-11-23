<script context="module">
    import Layout from "../layouts/Default.svelte";

    export const layout = Layout;
</script>

<script>
    import NoteList from "../components/NoteList.svelte";

    export let daily_notes;
</script>

<NoteList notes={daily_notes} />
