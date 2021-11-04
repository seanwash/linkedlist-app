import React from 'react';
import { usePage } from '@inertiajs/inertia-react';
import NoteEditor from '../NoteEditor';

const NoteList = () => {
  const {
    props: { notes },
  } = usePage();

  return (
    <div className="relative">
      {notes?.length
        ? notes.map((note) => <NoteEditor key={note.id} note={note} />)
        : null}
    </div>
  );
};

export default NoteList;
