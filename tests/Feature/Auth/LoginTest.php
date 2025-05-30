<?php

use App\Models\User;
use function Pest\Laravel\{post, get, actingAs};

it('permite login com credenciais válidas', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = post(route('login'), [
        'email' => 'user@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('products.index'));
    $this->assertAuthenticatedAs($user);
});

it('não permite login com credenciais inválidas', function () {
    User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = post(route('login'), [
        'email' => 'user@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

it('permite logout', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = get(route('logout'));

    $response->assertRedirect(route('login'));
    $this->assertGuest();
});
