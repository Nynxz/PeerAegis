<div class="flex flex-grow overflow-hidden">
    <div class="grid grid-cols-8 2xl:grid-cols-5 gap-2 grid-rows-1 text-2xl font-bold text-white p-2 w-full">
        <div class="col-span-3 2xl:col-span-1 lg:col-span-3 row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 " style="">
            <div class="p-2 rounded-md text-xl md:text-md">
                {{Auth::user()->name}}
            </div>
            <h1 class="pb-1 text-sm xl:text-2xl">
                TODO: Peer Reviews
            </h1>
            <hr class="border-gray-600">
            <div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
                <div    class=" p-2 pt-2 rounded-md ">
                    <ul class="">
                        @foreach($students as $student)
                            <li class="flex flex-row flex-grow rounded-md my-2 group  cursor-pointer  ">
                                <div class="group-hover:underline flex-grow flex-nowrap overflow-hidden group-hover:bg-slate-500 overflow-ellipsis whitespace-nowrap border-black border-2 rounded-md rounded-r-none min-w-0 group-hover:border-slate-600">
                                    {{$student->name}}
                                </div>
                                <div class="xl:min-w-8 xl:max-w-8  min-w-4 border-2 border-black rounded-md rounded-l-none ml-1 {{ random_int(0, 1) < 1 ? ' group-hover:bg-green-400 bg-green-500' : 'group-hover:bg-red-400 bg-red-500' }} group-hover:border-slate-600">
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
        </div>
        <div class="col-span-5 2xl:col-span-4 lg:col-span-5 bg-transparent backdrop-blur-[2px] bg-opacity-15 rounded-md border-[1px] border-gray-600 shadow-md group hover:animate-pulse">
            <div class="absolute w-full h-full rounded-md group-hover:animate-pulse hover:ring-2 hover:ring-blue-500 "></div>
            {{ $selected }}
        </div>
    </div>

</div>


{{--<div class="col-span-1">h</div>--}}
{{--<div class="col-span-1">h</div>--}}
{{--<div class="flex flex-shrink justify-center"> <img src="pillar.svg" class="w-8 pr-2"/> Welcome to Peer Aegis </div>--}}
{{--<span>    A place for students to submit peer reviews!</span>--}}
{{--<span>    Please login!</span>--}}
{{--<span>    // If already Logged in</span>--}}
{{--<span>    Welcome, NAME</span>--}}
{{--<span>    Here is your todo list!</span>--}}


