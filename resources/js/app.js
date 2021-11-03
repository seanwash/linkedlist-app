import './bootstrap'
import Alpine from 'alpinejs'
import {Editor} from "@tiptap/core";
import StarterKit from "@tiptap/starter-kit";
import TaskList from '@tiptap/extension-task-list'
import TaskItem from '@tiptap/extension-task-item'
import Typography from '@tiptap/extension-typography'
import Strike from '@tiptap/extension-strike'

window.setupEditor = function (content) {
    return {
        editor: null,
        content: content,

        init(element) {
            this.editor = new Editor({
                element: element,
                extensions: [
                    StarterKit,
                    TaskList,
                    TaskItem,
                    Typography,
                    Strike
                ],
                editorProps: {
                    attributes: {
                        class: "focus:outline-none"
                    }
                },
                content: this.content,
                onUpdate: ({editor}) => {
                    this.content = editor.getHTML()
                }
            });

            this.$watch('content', (content) => {
                // If the new content matches TipTap's then we just skip.
                if (content === this.editor.getHTML()) return

                /*
                  Otherwise, it means that a force external to TipTap
                  is modifying the data on this Alpine component,
                  which could be Livewire itself.
                  In this case, we just need to update TipTap's
                  content and we're good to do.
                  For more information on the `setContent()` method, see:
                    https://www.tiptap.dev/api/commands/set-content
                */
                this.editor.commands.setContent(content, false)
            });
        }
    }
};

window.Alpine = Alpine
Alpine.start();
