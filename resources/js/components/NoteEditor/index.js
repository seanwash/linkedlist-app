import React, { useEffect } from 'react';
import { EditorContent, useEditor } from '@tiptap/react';
import StarterKit from '@tiptap/starter-kit';
import TaskList from '@tiptap/extension-task-list';
import TaskItem from '@tiptap/extension-task-item';
import Typography from '@tiptap/extension-typography';
import { useForm } from '@inertiajs/inertia-react';
import { useDebounce } from 'react-use';

const SAVE_NOTE_DEBOUNCE = 1000;

const NoteEditor = ({ note }) => {
  const editor = useEditor({
    extensions: [StarterKit, TaskList, TaskItem, Typography],
    content: note.content,
  });

  const form = useForm({
    content: note.content,
  });

  useDebounce(() => form.put(`/n/${note.id}`), SAVE_NOTE_DEBOUNCE, [
    form.data.content,
  ]);

  useEffect(() => {
    editor?.on('update', ({ editor }) => {
      form.setData({
        content: editor.getHTML(),
      });
    });
  }, [editor]);

  return (
    <article>
      <h3 className="py-2 px-6 bg-gray-50 font-semibold border-b border-gray-200">
        {note.title}
      </h3>
      <div className="p-6 bg-white">
        <EditorContent editor={editor} />
      </div>
    </article>
  );
};

export default NoteEditor;
