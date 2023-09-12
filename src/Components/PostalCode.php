<?php

namespace Rmsramos\PostalCode\Components;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Component as Livewire;

class PostalCode extends TextInput
{
    public function viaCep(string $errorMessage = 'CEP inválido.', array $setFields = []): static
    {
        $viaCepRequest = function ($state, $livewire, $set, $component, string $errorMessage, array $setFields) {

            $livewire->validateOnly($component->getKey());

            $request = Http::get("viacep.com.br/ws/$state/json/")->json();

            foreach ($setFields as $key => $value) {
                $set($key, $request[$value] ?? null);
            }

            if (Arr::has($request, 'erro')) {
                throw ValidationException::withMessages([
                    $component->getKey() => $errorMessage,
                ]);
            }

            $livewire->dispatch('cep');
        };

        $this
            ->minLength(9)
            ->mask('99999-999')
            ->afterStateUpdated(function ($state, Livewire $livewire, Set $set, Component $component) use ($errorMessage, $setFields, $viaCepRequest) {
                $viaCepRequest($state, $livewire, $set, $component, $errorMessage, $setFields);
            })
            ->suffixAction(
                Action::make('search-action')
                    ->label('Buscar CEP')
                    ->icon('heroicon-o-magnifying-glass')
                    ->action(function ($state, Livewire $livewire, Set $set, Component $component) use ($errorMessage, $setFields, $viaCepRequest) {
                        $viaCepRequest($state, $livewire, $set, $component, $errorMessage, $setFields);
                    })
                    ->cancelParentActions()
            );

        return $this;
    }
}
