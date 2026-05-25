<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->native(false)
                    ->displayFormat('d M Y H:i'),

                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->rule(Password::defaults())
                    ->same('passwordConfirmation')
                    ->dehydrated(fn ($state): bool => filled($state))
                    ->revealable(),

                TextInput::make('passwordConfirmation')
                    ->password()
                    ->label('Confirm Password')
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(false)
                    ->revealable(),
            ]);
    }
}
