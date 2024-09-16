<div class=" grid grid-cols-3  text-center flex-col w-full">
    <div class="grid-cols-1"></div>
    <div
        class="col-span-1 flex group/a flex-col border-gray-600 self-center rounded-md border-[1px] bg-primary p-4 bg-transparent backdrop-blur-[3px] bg-opacity-15 min-w-96">
        <div class="flex w-full  justify-between text-center">
            <span class="font-bold text-3xl underline text-white justify-center w-full">Register</span>
            <a href="/login">
                <span class="font-bold text-md  text-white justify-end absolute right-8 hover:underline">Login</span>
            </a>
        </div>
        <form wire:submit="register" class="flex flex-row  pt-8 gap-2 rounded-md text-2xl font-bold h-min">
            <div class="flex flex-col gap-2 my-auto">
                <input type="text" wire:model="name" name="name" class=" rounded-md min-w-0 w-full"
                       placeholder="Name">
                <input type="text" wire:model="s_number" for="s_number" name="s_number" class=" rounded-md min-w-0 w-full"
                       placeholder="Student Number">
                <input type="text" wire:model="email" name="email" class=" rounded-md min-w-0 w-full"
                       placeholder="Email">
                <input type="password" wire:model="password" name="password" class=" rounded-md min-w-0 w-full"
                       placeholder="Password">
            </div>
            <div
                class="cursor-pointer flex flex-grow  rounded-md bg-gradient-to-l  group/b active:ring active:ring-blue-500 bg-opacity-0 from-[rgb(0_0_0/.5)_5%] hover:from-[rgb(0_0_0/.9)_5%] backdrop-blur-sm bg-secondary border-gray-600 border-[1px] hover:text-white px-2 my-2">
                <button type="submit " class="flex flex-grow">
                <span class="my-auto">
                REGISTER
                </span>
                    <div class="pl-2 flex flex-col flex-grow overflow-clip text-sm my-auto text-red-500 font-bold">
                            @error('s_number')<span class="error rounded-md font-bold">{{ $message }}</span> @enderror
                            @error('password')<span class="error rounded-md font-bold">{{ $message }}</span> @enderror
                            @error('email')<span class="error rounded-md font-bold">{{ $message }}</span> @enderror
                            @error('name')<span class="error rounded-md font-bold">{{ $message }}</span> @enderror
                    </div>
                </button>

                @error('s_number')
                <div
                    class="absolute w-full h-full rounded-md animate-pulse ring-2 ring-red-500 pointer-events-none left-0 top-0"></div>
                @enderror
                <div
                    class="absolute w-full h-full rounded-md group-hover/b:animate-pulse group-hover/b:ring-2 group-hover/b:ring-blue-500 pointer-events-none left-0 top-0"></div>

            </div>
        </form>

        @error('s_number')
        <div
            class="absolute w-full h-full rounded-md animate-pulse ring-2 ring-red-500 pointer-events-none left-0 top-0"></div>
        @enderror
        <div
            class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none left-0 top-0"></div>


    </div>

</div>
