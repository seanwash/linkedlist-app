import React from 'react';
import MainNavigation from '../../components/MainNavigation';
import NoteList from '../../components/NoteList';

const Index = () => {
  return (
    <div className="min-h-screen bg-gray-100">
      <MainNavigation />

      <section className="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <NoteList />
        </div>
      </section>
    </div>
  );
};

export default Index;
