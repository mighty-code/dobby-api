@php /** @var \App\Models\User $user */ @endphp
@php /** @var \Laravel\Sanctum\PersonalAccessToken $token */ @endphp
<div>
    <form wire:submit.prevent="createToken" class="flex flex-col space-y-4 my-4">
        <div>
            <input class="form-control" type="text" required placeholder="Token name" wire:model="tokenName">
        </div>

        <div class="flex justify-center">
            <button type="submit"
                    class="border-4 border-white rounded-full text-white text-xl py-2 px-14 block disabled:text-gray-400 disabled:border-gray-400"
            >
                Create Token
            </button>
        </div>
        @if($tokenPlain)
            <div class="text-xl text-white bg-blue-900 p-5 rounded flex flex-col space-y-2">
                <span class="font-bold">Plain Token:</span>
                <span class="font-mono">{{ $tokenPlain }}</span>
                <div class="text-red-500">
                    Please save this token, you can not access it again.
                </div>
            </div>
        @endif
    </form>

    <h2 class="my-4 text-2xl text-white">Your tokens</h2>

    <div class="text-white flex flex-col space-y-4 mt-10">
        @foreach ($user->tokens as $token)
         <div class="grid grid-cols-5 border border-white rounded-xl p-5">
             <div class="col-span-3">
                 {{ $token->name }}
             </div>
             <div class="col-span-2 flex justify-end">
                 <x-icons.trash class="w-7 h-7 cursor-pointer" wire:click="deleteToken({{ $token->id }})"></x-icons.trash>
             </div>
         </div>

        @endforeach
    </div>
</div>
