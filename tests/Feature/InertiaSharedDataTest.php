<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Inertia\Testing\Assert;

test('auth.user contains the current user data', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('notes.index'))
        ->assertInertia(fn(Assert $page) => $page
            ->has('auth', fn(Assert $page) => $page
                ->where('user', $user->only('id', 'email'))
            )
        );
});

test('last_daily_note_at is present if the user has a daily note', function () {
    $user = User::factory()->create();
    $note = Note::factory()->create(['user_id' => $user, 'for_date' => now()]);

    $this->actingAs($user)
        ->get(route('notes.index'))
        ->assertInertia(fn(Assert $page) => $page
            ->where('last_daily_note_at', $note->for_date->toJSON())
        );
});

test('last_daily_note_at is null if the user does not have any daily notes', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('notes.index'))
        ->assertInertia(fn(Assert $page) => $page
            ->where('last_daily_note_at', null)
        );
});

test('search.query contains a value matching request.query.s', function () {
    $user = User::factory()->has(Note::factory()->count(3))->create();
    $query = 'sean';

    $this->actingAs($user)
        ->get(route('notes.index', ['s' => $query]))
        ->assertInertia(fn(Assert $page) => $page
            ->where('search.query', $query)
        );
});

test('search.notes only contains notes belonging to the current user', function () {
    $expected_notes_count = 3;
    $user = User::factory()->has(Note::factory()->count($expected_notes_count))->create();
    User::factory()->has(Note::factory()->count(3))->create();

    $this->actingAs($user)
        ->get(route('notes.index'))
        ->assertInertia(fn(Assert $page) => $page
            ->has('search.notes', $expected_notes_count)
        );
});

test('search.notes only contains notes belonging to the current user when a search query is present', function () {
    $expected_notes_count = 3;
    $user = User::factory()->has(Note::factory(['title' => 'Linked List'])->count($expected_notes_count))->create();
    User::factory()->has(Note::factory(['title' => 'Linked List'])->count(3))->create();

    $this->actingAs($user)
        ->get(route('notes.index', ['s'=> 'Linked list']))
        ->assertInertia(fn(Assert $page) => $page
            ->has('search.notes', $expected_notes_count)
        );
});
