<div class="flex flex-grow overflow-hidden max-h-screen">
    <div class="grid grid-cols-6  grid-rows-1 text-2xl font-bold text-white p-2 w-full h-full">
        <div class="col-span-2 row-span-2 grid grid-cols-1 grid-rows-3 border-gray-600 rounded-md  bg-transparent backdrop-blur-[2px] bg-opacity-15">
{{--            COURSE SELECTOR --}}
            <div class= "col-span-1 row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 m-1">
                <div class="p-2 rounded-md text-xl md:text-md flex flex-row justify-between">
                    <h1 class="pb-1 text-sm xl:text-2xl">
                        Courses
                    </h1>
                    {{Auth::user()->name}}
                </div>

                <hr class="border-gray-600">
                <div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
                    <div    class=" p-2 pt-2 rounded-md ">
                        <ul class="">
                            @foreach($courses as $course)
                                <li class="flex flex-row flex-grow rounded-md my-2 group  cursor-pointer  " wire:click="selectCourse({{$course}})">
                                    <div class="group-hover:underline flex-grow flex-nowrap overflow-hidden group-hover:bg-slate-500 overflow-ellipsis whitespace-nowrap {{$selected_course != null && $course->id == $selected_course->id ? 'border-blue-500' : 'border-black'}} border-2 rounded-md rounded-r-none min-w-0 group-hover:border-slate-600">
                                        {{$course->name}}
                                    </div>
                                    <div class="xl:min-w-8 xl:max-w-8  min-w-4 border-2 {{$selected_course != null && $course->id == $selected_course->id ? 'border-blue-500' : 'border-black'}} rounded-md rounded-l-none ml-1 {{ random_int(0, 1) < 1 ? ' group-hover:bg-green-400 bg-green-500' : 'group-hover:bg-red-400 bg-red-500' }} group-hover:border-slate-600">
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>

            </div>
{{--            ASSESSMENT SELECTOR --}}
            <div class="col-span-1 row-span-2 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 m-1">
                <div class="p-2 rounded-md text-xl md:text-md flex flex-row justify-between">
                    <h1 class="pb-1 text-sm xl:text-2xl">
                        Assessment
                    </h1>
                    @if($selected_course)
                        {{$selected_course->code}}
                    @endif
                </div>
                <hr class="border-gray-600">
                <div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
                    <div    class=" p-2 pt-2 rounded-md ">
                        <ul class="">
                            @if($selected_course != null)
                                <ul>
                                    @foreach($selected_course->assessments()->get() as $assessment)
                                        <li>
                                            {{ $assessment->title }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </ul>
                    </div>
                </div>
            <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>

{{--            PEER REVIEWER PANEL --}}
        </div>
        <div class="col-span-4 row-span-2 grid grid-cols-1 grid-rows-3 border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 m-1">
            <div class="absolute w-full h-full rounded-md group-hover:animate-pulse hover:ring-2 hover:ring-blue-500 "></div>
            @if($selected_course != null)
                <ul>
                    @foreach($selected_course->assessments()->get() as $assessment)
                    <li>
                        {{ $assessment->title }}
                    </li>
                    @endforeach
                </ul>
            @endif
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


