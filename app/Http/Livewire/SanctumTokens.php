<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SanctumTokens extends Component
{

    public string $tokenName = '';
    public string $tokenPlain = '';

    public function render()
    {
        return view('livewire.sanctum-tokens', ['user' => auth()->user()]);
    }

    public function createToken()
    {
        $this->validate([
            'tokenName' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        $token = auth()->user()->createToken($this->tokenName);
        $this->tokenPlain = $token->plainTextToken;
    }

    public function deleteToken($tokenId)
    {
        auth()->user()->tokens()->find($tokenId)->delete();
    }
}
