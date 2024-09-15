<div class=" grid grid-cols-3  text-center flex-col w-full">
    <div class="grid-cols-1"></div>
    <div class="col-span-1 flex flex-col border-gray-600 h-1/4 self-center rounded-md border-[1px] bg-primary p-4 bg-transparent backdrop-blur-[3px] bg-opacity-15">
        <span class="font-bold text-3xl underline text-white">Login</span>
        <form wire:submit="login" class="flex flex-row w-1/2 mx-auto pt-8 gap-2 rounded-md text-2xl font-bold h-min">
            <div class="flex flex-col gap-2">
                <input type="text" wire:model="s_number" name="s_number" class=" rounded-md " placeholder="Student Number">
                <input type="password" wire:model="password" name="password"  class=" rounded-md " placeholder="Password">

            </div>
            <div class="flex flex-grow  rounded-md  bg-secondary border-gray-600 border-[1px] hover:bg-opacity-75 hover:bg-black hover:text-white px-2 my-2">
                <button type="submit">
            <span class="my-auto">
            LOGIN
            </span>
                </button>
            </div>
        </form>
        <div class="p-4">
            @error('s_number') <span class="error bg-red-600 rounded-md p-2 font-bold backdrop-blur-lg">{{ $message }}</span> @enderror
        </div>

        <div class="p-4">
            @error('password') <span class="error bg-red-300 rounded-md p-2 font-bold">{{ $message }}</span> @enderror
        </div>
    </div>

</div>
