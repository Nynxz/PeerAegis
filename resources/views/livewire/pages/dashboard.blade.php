@php use App\Models\Assessment; @endphp
<div class="flex flex-grow overflow-hidden max-h-screen">
    <div class="grid grid-cols-8  grid-rows-1 text-2xl font-bold text-white p-2 w-full h-full">
{{--        SIDE BAR --}}
        <div class="col-span-2 row-span-2 grid grid-cols-1 grid-rows-3 border-gray-600 rounded-md  bg-transparent backdrop-blur-[2px] bg-opacity-15">
{{--            COURSE SELECTOR --}}
            <div class= "col-span-1 row-span-1 flex flex-col border-[1px] border-gray-600 rounded-md  group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 m-1">
                <div class="p-2 rounded-md text-xl md:text-md flex flex-row justify-between">
                    <h1 class="text-sm xl:text-2xl">
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
                <div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip h-full">
                    <div class=" p-2 pt-2 rounded-md h-full ">
                        @if($selected_course != null)
                            <ul class="flex gap-2 flex-col h-full">
                                @foreach($selected_course->assessments()->get() as $assessment)
                                    <li wire:click="selectAssessment({{$assessment}})" class="hover:cursor-pointer hover:bg-white hover:bg-opacity-25 {{$selected_assessment != null && $assessment->id == $selected_assessment->id ? 'border-blue-500' : 'border-black'}} border-2 rounded-md">
                                        {{ $assessment->title }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
{{--            PEER REVIEWER PANEL --}}
        </div>

{{--        MAIN STUDENT DASHBOARD --}}
        <div class="col-span-6 row-span-2 grid grid-cols-3 grid-rows-5  rounded-md bg-transparent backdrop-blur-[2px] bg-opacity-15">
{{--            ASSESSMENT INFORMATION --}}
            <div class="col-span-1 row-span-1 flex flex-col border-[1px] m-1 border-gray-600 rounded-md group/a bg-transparent backdrop-blur-[2px] bg-opacity-15 ">
                <span class="p-2 border-b-[1px] border-gray-600">
                Selected Assessment
                </span>
                @if($selected_assessment != null)
                    <ul class=" p-2">
                        <li>Title: {{$selected_assessment->title}} </li>
                        <li>Due: {{$selected_assessment->due_date}} </li>
                        <li>Required Review: {{$selected_assessment->required_reviews}} </li>
                    </ul>
                @endif
                <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
{{--            MAIN REVIEW EDITING AREA --}}
            <div class="col-span-2 row-span-5 flex flex-col border-[1px] m-1 border-gray-600 rounded-md group/a bg-transparent backdrop-blur-[2px] bg-opacity-15">
                <div class="border-b-2 border-gray-600 p-2">
{{--                    Header--}}
                    @if($selected_user_type == 0 && $selected_user)
                        {{$selected_user != null ? "Writing Review for ".$selected_user->name : 'Review Editor'}}
                    @elseif($selected_user_type == 1)
                        {{$selected_user != null ? "Viewing ".$selected_user->name."'s Review of You": 'Review Editor'}}
                    @else
                        Select a Review
                    @endif
                </div>
                <div class="flex flex-grow  flex-col rounded-b-md overflow-y-scroll pl-3">

                @if($selected_user_type == 0 && $selected_user)
                    <form wire:submit="send_review" class="rounded-md p-1 w-full text-white">
                        <label>Review</label>
                        <textarea name="review" wire:model="review_content" class="w-full rounded-md h-[25vh] text-black" ></textarea>
                        <button type="submit" class="rounded-md border-2 border-gray-600 p-2 hover:border-blue-500 ">Send Review</button>
                        <button type="button" wire:click="generateAIResponse" wire:loading.remove class="rounded-md border-2 border-gray-600 p-2 hover:border-blue-500">AI Feedback</button>
                        <div wire:loading>
                            Generating AI Response...
                        </div>
                    </form>

                <div class="flex flex-grow flex-col bg-opacity-25 mb-2 rounded-md border-gray-600 border-2">
                    <div class="border-b-2 border-gray-600 w-full p-2">
                    AI Helper
                    </div>
                    <div class="p-2  h-full rounded-b-md min-h-40">
{{--                        <div>Usefulness: 0</div>--}}
                        {{$http_message}}
                    </div>
                </div>
                    @elseif($selected_user_type == 1)
                    {{$selected_review}}
                @endif
                </div>
            <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
{{--            POTENTIAL PEER REVIEWS --}}
            <div class="col-span-1 row-span-3 flex flex-col border-[1px] m-1 border-gray-600 rounded-md group/a bg-transparent backdrop-blur-[2px] bg-opacity-15">
                   <span class="p-2 border-b-[1px] border-gray-600">
                    Potential Reviewees
                </span>
                <div class="m-2 max-h-fit overflow-y-scroll overflow-x-clip">
                @if($selected_assessment != null)
                    <ul class="">
                        @foreach($group_users_to_review as $user)
                            <li  wire:click="selectUser({{$user}}, 0)" class="m-2 pl-1 rounded-md cursor-pointer hover:bg-white hover:bg-opacity-25 {{$selected_user_type == 0 && $selected_user != null && $user->id == $selected_user->id ? "ring-2 ring-blue-500" : ''}}">{{$user['name']}}</li>
                        @endforeach
{{--                        @foreach($selected_course->students()->get() as $student)--}}
{{--                        <li>--}}
{{--                            {{$student->name}}--}}
{{--                        </li>--}}
{{--                        @endforeach--}}
                    </ul>
                @endif
                </div>
                <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
{{-- RECIEVED REVIEWS --}}
            <div class="col-span-1 row-span-1 flex flex-col border-[1px] m-1 border-gray-600 rounded-md group/a bg-transparent backdrop-blur-[2px] bg-opacity-15">
                <span class="p-2 border-b-[1px] border-gray-600">
                    Received Reviews
                </span>
                <div class="m-2 max-h-fit overflow-y-scroll overflow-x-clip">

                    @if($selected_assessment != null)
                        <ul>
                            @foreach($this->group_reviews as $review)
                                <li wire:click="selectUser({{$review->reviewer()->first()}}, 1)" class="m-2 pl-1 rounded-md cursor-pointer hover:bg-white hover:bg-opacity-25 {{$selected_user_type == 1 && $selected_user != null && $user->id == $selected_user->id ? "ring-2 ring-blue-500" : ''}}">
                                    {{$review->reviewer()->first()->name}}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="absolute w-full h-full rounded-md group-hover/a:animate-pulse group-hover/a:ring-2 group-hover/a:ring-blue-500 pointer-events-none"></div>
            </div>
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


