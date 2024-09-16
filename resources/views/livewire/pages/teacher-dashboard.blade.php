<div class="flex flex-grow overflow-hidden max-h-screen">
    <div class="grid grid-cols-6 gap-2 grid-rows-1 text-2xl font-bold text-white p-2 w-full h-full">
        {{--        SIDE BAR--}}
        <div
            class="col-span-1 row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15">
            <div class="p-2 rounded-md text-xl md:text-md">
                Courses for {{ Auth::user()->name }}
            </div>
            <hr class="border-gray-600">
            <div class="max-h-fit overflow-y-scroll overflow-x-clip">
                <div class="p-2 rounded-md ">
                    <ul>
                        @foreach($courses as $course)
                            <li class="px-1 flex flex-row flex-grow rounded-md mb-2 group cursor-pointer text-sm bg-purple-400"
                                wire:click="select({{ $course->id }})">
                                {{ $course->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
        </div>

        {{--        MAIN DASHBOARD--}}
        <div class="col-span-5 row-span-1  grid grid-cols-3 grid-rows-5 gap-2 rounded-md">
{{--            SELECTED COURSE WIDGET --}}
            <div
                class="col-span-1 row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 p-2">
                @if($selected)
                    <ul class="list-none">
                        <li>{{ $selected->name }}</li>
                        <li>ID: {{ $selected->id }}</li>
                        <li>Code: {{ $selected->code }}</li>
                        <li>Students: 0</li>
                    </ul>
                @endif
                <div
                    class="absolute w-full h-full top-0 left-0 rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
{{-- NEW ASSESSMENT FORM --}}
            <div
                class="col-span-1 row-span-3 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15">
                <div class="p-2 rounded-md text-xl md:text-md">
                    Selected: @if($selectedAssessment)
                        {{ $selectedAssessment['title'] }}
                    @endif
                </div>
                <hr class="border-gray-600">
                <div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
                    <livewire:components.new-assessment-form :course="$selected" @submitted="refreshCourse()"/>
                </div>
                {{-- HOVER RING--}}
                <div class="absolute w-full h-full top-0 left-0 rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>

{{-- SELECTED ASSESSMENT INFORMATION --}}
            <div class="col-span-1 row-span-5 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 p-2">
                @if($selectedAssessment)
                    <ul class="list-none">
                        <li>{{ $selectedAssessment['title'] }}</li>
                        <li>{{ $selectedAssessment['instructions'] }}</li>
                        <li>{{Carbon\Carbon::parse($selectedAssessment['due_date'])->format('d M Y | h:iA')}}</li>
                        <li>{{ $selectedAssessment['required_reviews'] }}</li>
                        <li>{{ $selectedAssessment['type'] }}</li>
                        <li>{{ $selectedAssessment['minimum_grade'] }}</li>
                        {{--https://carbon.nesbot.com/docs/--}}
                    </ul>
                @endif
                    {{-- HOVER RING--}}
                <div class="absolute w-full h-full top-0 left-0 rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
{{-- SELECTED COURSE TEACHER LIST --}}
            <div class="col-span-1 row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 p-2">
                <div class="col-span-2 row-span-5 border-gray-600 border-[1px] rounded-md p-2">
                    Teachers
                    <button wire:click="addTeacher">Add</button>
                    @if($selected)
                        <ul class="list-none">
                            @foreach($selected->teachers as $teacher)
                                <li>{{ $teacher->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                {{-- HOVER RING--}}
                <div class="absolute w-full h-full top-0 left-0 rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
{{-- SELECTED COURSE ASESSEMENT LIST --}}
            <div
                class="col-span-1 row-span-2 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15">
                <div class="p-2 rounded-md text-xl md:text-md">
                    Assessments: @if($selectedAssessment)
                        {{ $selectedAssessment['title'] }}
                    @endif
                </div>
                <hr class="border-gray-600">
                <div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
                    <livewire:components.assessment-list :course="$selected"  @ss="selectAssessment($event.detail.assessment)"/>
                </div>
                {{-- HOVER RING--}}
                <div class="absolute w-full h-full top-0 left-0 rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
{{-- SELECTED COURSE STUDENT LIST --}}
            <div class="col-span-1 row-span-3 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15">
                <div class="p-2 rounded-md text-xl md:text-md flex flex-row gap-2">
                    Name: <input type="text" name="name" id="name" class="w-full rounded-md text-black" wire:model.live.debounce.150ms="name_search">
                </div>
                <hr class="border-gray-600">
                <div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
                    <livewire:components.student-adder :name_search="$name_search"/>
                </div>
                {{-- HOVER RING--}}
                <div class="absolute w-full h-full top-0 left-0 rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
        </div>
    </div>
</div>
