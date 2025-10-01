<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Login extends \Filament\Auth\Pages\Login
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'test@example.com',
            'password' => 'password'
        ]);
    }
}
