<script context="module">
    import Layout from "../../layouts/Default.svelte";

    export const layout = Layout;
</script>

<script>
    import NoteEditor from "../../components/NoteEditor.svelte";

    export let note;
</script>

<NoteEditor {note} />
