<div class="flex flex-row bg-primary group">
    <div
        class="flex flex-grow bg-primary rounded-br-lg max-w-[2%] border-gray-600 border-b-[1px] border-r-[1px] shadow-sm group-hover:shadow-gray-600/50"></div>
    <div class="flex  bg-secondary ">
        <h1 class="text-2xl flex font-bold  p-4 mb-0 rounded text-white ">
            <a href="/" class="flex flex-row">
                <img src="{{asset('pillar.svg')}}" class="h-8 pr-2" alt="pillar"/>
                PeerAegis
            </a>
        </h1>
    </div>
    <div class="flex flex-grow bg-primary rounded-bl-lg border-gray-600 border-[1px] border-t-0 border-r-0 shadow-sm group-hover:shadow-gray-600/50">
        <div class="flex flex-grow justify-end my-auto">
            @if(Gate::allows('teacher', Auth::user()))
                Teacher!
            @endif

            @if(Auth::user())
                <ul class="my-auto mr-4 pr-2 text-white text-xl flex justify-end flex-grow gap-2 border-r-white border-r-[1px]">
                    <li><a class="hover:underline hover:animate-pulse" href="/test" wire:navigate>{{Auth::user()->name}}</a>
                </ul>
            @endif

            <ul class="my-auto pr-4 text-white text-xl flex justify-end gap-2">
                @if(Auth::user())
                    <li><a class="hover:underline cursor-pointer hover:animate-pulse" wire:click="logout">Logout</a></li>
                @else
                    <li><a class="hover:underline hover:animate-pulse" href="/login" wire:navigate>Login</a></li>
                @endif
                <li><a class="hover:underline hover:animate-pulse" href="/test" wire:navigate>Test</a></li>
                <li><a class="hover:underline hover:animate-pulse" href="/dashboard" wire:navigate>Dashboard</a></li>
            </ul>

        </div>

    </div>
</div>
