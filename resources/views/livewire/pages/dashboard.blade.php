<div class="flex flex-grow overflow-hidden">
    <div class="grid grid-cols-5 gap-2 grid-rows-1 text-2xl font-bold text-white p-2 w-full">
        <div class="col-span-1  row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md bg-transparent backdrop-blur-[2px] bg-opacity-15 hover:ring-2 hover:ring-blue-500" style="">
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
                                <div class="group-hover:underline xl:text-xl text-sm flex-grow flex-nowrap overflow-hidden group-hover:bg-slate-500 overflow-ellipsis whitespace-nowrap border-black border-2 rounded-md rounded-r-none min-w-0 group-hover:border-slate-600">
                                    {{$student->name}}
                                </div>
                                <div class="xl:min-w-8 xl:max-w-8  min-w-4 border-2 border-black rounded-md rounded-l-none ml-1 {{ random_int(0, 1) < 1 ? ' group-hover:bg-green-400 bg-green-500' : 'group-hover:bg-red-400 bg-red-500' }} group-hover:border-slate-600">
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-span-4 bg-transparent backdrop-blur-[2px] bg-opacity-15 rounded-md border-[1px] border-gray-600 shadow-md hover:ring-2 hover:ring-blue-500">
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


