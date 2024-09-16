<div class="flex flex-grow overflow-hidden">
<div class="grid grid-cols-6 gap-2 grid-rows-1 text-2xl font-bold text-white p-2 w-full">
    {{--        SIDE BAR--}}

    <div class="col-span-1 row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 " style="">
                <div class="p-2 rounded-md text-xl md:text-md">
                    {{ Auth::user()->name }}
                </div>
                <h1 class="pb-1 text-sm xl:text-2xl">
                    Hi
{{--                    TODO: Peer Reviews--}}
                </h1>
                <hr class="border-gray-600">
        <div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
            <div    class=" p-2 pt-2 rounded-md ">
                <ul class="">
                    @foreach($courses as $course)
                        <li class="flex flex-row flex-grow rounded-md my-2 group cursor-pointer"
                            wire:click="select({{ $course->id }})">
                            {{ $course->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
    </div>
{{--    <div class="col-span-1 row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 ">--}}
{{--        <div class="p-2 rounded-md text-xl md:text-md">--}}
{{--            {{ Auth::user()->name }}--}}
{{--        </div>--}}
{{--        <h1 class="pb-1 text-sm xl:text-2xl">--}}
{{--            TODO: Peer Reviews--}}
{{--        </h1>--}}
{{--        <hr class="border-gray-600">--}}
{{--        <div class="m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip ">--}}
{{--            <div class="p-2 pt-2 rounded-md">--}}
{{--                <ul class="list-none">--}}
{{--                    @foreach($courses as $course)--}}
{{--                        <li class="flex flex-row flex-grow rounded-md my-2 group cursor-pointer"--}}
{{--                            wire:click="select({{ $course->id }})">--}}
{{--                            {{ $course->name }}--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>--}}
{{--    </div>--}}


{{--        MAIN DASHBOARD--}}
    <div class="flex flex-grow flex-col col-span-5 row-span-1 min-w-full bg-transparent backdrop-blur-[2px] bg-opacity-15 rounded-md border-[1px] border-gray-600 shadow-md group/a">
        {{--            HEADER--}}
        <div class="p-2 rounded-t-md">
            Selected: @if($selected)
                {{ $selected->name }}
            @endif
        </div>
        <button wire:click="test">
            Click me :0
        </button>
{{--     DASHBOARD--}}
        <div class="grid grid-rows-4 grid-cols-4 border-t-[1px] border-gray-600 w-full bg-red-500 group/a">

            {{--            <div class="grid row-span-4 col-span-4 p-2 gap-1 bg-purple-400">--}}
{{--                <div class="col-span-1 row-span-1 border-gray-600 border-[1px] rounded-md ">--}}
{{--                    @if($selected)--}}
{{--                        <ul class="list-none">--}}
{{--                            <li>ID: {{ $selected->id }}</li>--}}
{{--                            <li>Code: {{ $selected->code }}</li>--}}
{{--                            <li>Students: 0</li>--}}
{{--                        </ul>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div--}}
{{--                    class="col-span-1 row-span-1 border-gray-600 border-[1px] rounded-md flex-grow overflow-y-auto">--}}
{{--                    <livewire:components.new-assessment-form :course="$selected"/>--}}
{{--                </div>--}}

{{--                <div class="col-span-4 row-span-5 border-gray-600 border-[1px] rounded-md ">--}}
{{--                    <div class="flex-grow overflow-y-auto"> <!-- Ensure this div scrolls -->--}}
{{--                        <ul class="list-none">--}}
{{--                            @foreach($students as $student)--}}
{{--                                <li class="rounded-md cursor-pointer">{{ $student->name }}</li>--}}
{{--                                <!-- Example item for testing -->--}}
{{--                                <li>a</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-span-2 row-span-5 border-gray-600 border-[1px] rounded-md p-2">--}}
{{--                    Teachers--}}
{{--                    <button wire:click="addTeacher">Add</button>--}}
{{--                    @if($selected)--}}
{{--                        <ul class="list-none">--}}
{{--                            @foreach($selected->teachers as $teacher)--}}
{{--                                <li>{{ $teacher->name }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
            <div class="absolute flex flex-grow w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none top-0 left-0"></div>
    </div>
        <div class="absolute w-full h-full rounded-md group-hover:animate-pulse hover:ring-2 hover:ring-blue-500 pointer-events-none"></div>

{{--        <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none top-0 left-0"></div>--}}
</div>
</div>
