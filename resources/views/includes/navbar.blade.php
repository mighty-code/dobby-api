@auth
    <div x-data="{
        isOpen: false,
        time: '',
        setTime() {
            this.time = window.format(new Date, 'HH:mm:ss')
            setTimeout(() => this.setTime(), 1000)
        }
    }"
         x-init="setTime()"
         class="fixed top-0 text-white w-full"
         x-on:click.away="isOpen = false"
    >
        <template x-if="isOpen">
            <div>
                <div class="bg-gray-700 p-4">
                    <h4 class="text-white text-2xl font-semibold py-2">Settings</h4>
                    <div class="flex flex-col text-xl space-y-2">
                        @if(!auth()->user()->first_login)
                            <a href="{{ route('manage') }}" class="flex space-x-1">
                                <x-icons.clock class="w-7 h-7"/>
                                <div>Connections</div>
                            </a>
                            <a href="{{ url('storage/extension.crx')}}" target="_blank"
                               class="flex space-x-1">
                                <x-icons.computer class="w-7 h-7"/>
                                <div>Chrome Extension</div>
                            </a>
                            <a href="{{ route('api.manage') }}" class="flex space-x-1">
                                <x-icons.puzzle class="w-7 h-7"/>
                                <div>API</div>
                            </a>
                        @endif
                        <div class="col-12">
                            <a class="flex space-x-1" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <x-icons.logout class="w-7 h-7"/>
                                <div>Sign out</div>
                            </a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </template>
        <nav class="flex justify-between w-full bg-transparent p-3">
            <x-icons.cog class="cursor-pointer h-8 w-8" x-on:click="isOpen = !isOpen"/>
            <div class="font-mono" x-text="time"></div>
        </nav>
    </div>
@endauth
