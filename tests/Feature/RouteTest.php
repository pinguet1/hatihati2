<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

beforeEach(function () {
   $this->user = User::factory()->create(['id'=> 1]);

   actingAs($this->user);
});

it ('signs in Angello and returns home view', function () {

    $response = $this->withSession(['banned' => false])
        ->get('/signin/angello');

    $response->assertOk();

    $response->assertViewIs('home');

});
