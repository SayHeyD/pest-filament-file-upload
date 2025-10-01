<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('can edit profile', function () {
    Storage::fake('local');
    $user = User::factory()->create();
    $this->actingAs($user);

    $newName = 'Some Cheesy Name';

    visit(route('filament.admin.auth.profile'))
        ->assertSee('Profile')
        ->assertSee('Avatar')
        ->fill('#form\\.name', $newName)
        ->click('Save changes')
        ->screenshot();

    expect($user->name)->toEqual($newName);
});

test('can upload file', function () {
    // This fails
    Storage::fake('local');
    $user = User::factory()->create();
    $this->actingAs($user);

    visit(route('filament.admin.auth.profile'))
        ->assertSee('Profile')
        ->assertSee('Avatar')
        ->attach('input.filepond--browser', base_path('tests/Browser/assets/img.png'))
        ->assertSee('Uploading files...')
        ->wait(10)
        ->click('Save changes')
        ->screenshot();

    expect($user->avatar_url)->not()->toBeNull();
});
