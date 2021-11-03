<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use function Pest\Laravel\actingAs;

test('is found', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('redirects authenticated users to the configured home route', function () {
    actingAs(User::factory()->create());

    $this->get('/')
        ->assertRedirectContains(RouteServiceProvider::HOME);
});
