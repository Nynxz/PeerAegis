<div class=" rounded-md ">
<div class="overflow-clip">
    @if($course && Gate::allows('createAssessment', $course))
{{--            Can create!--}}
{{--    @if($error)--}}
{{--        {{$error}}--}}
{{--    @endif--}}
    <form wire:submit="newAssessment" class=" rounded-md text-2xl font-bold h-min text-black w-full flex-grow">
        <div class="flex flex-col gap-2 flex-grow ">
            <input type="text" wire:model="title" name="title" for="title" class="rounded-md mx-1 mt-1 min-w-0 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-none p-1"
                   placeholder="Title">
            <textarea type="text" wire:model="instructions" name="instructions" for="instructions"
                   class=" rounded-md mx-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-none p-1"
                      placeholder="Instructions"></textarea>
            <input type="datetime-local" wire:model="due_date" name="due_date" for="due_date"
                   class="rounded-md mx-1 min-w-0 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-none p-1"
                   placeholder="Date">

            <div class="flex flex-grow flex-row">
                <input type="range" min="1" max="100"
                       value="50" class="flex-grow rounded-md mx-1 min-w-0  p-1" id="max_score"
                       wire:model.live.debounce.50ms="max_score" for="max_score">
                <span class="text-white w-12 pl-2">
                    {{$max_score}}
                </span>
            </div>

            <input type="number" name="required_reviews" for="required_reviews"
                   class="  rounded-md mx-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-none p-1"
                   placeholder="Required Reviews" min="1"
                   wire:model="required_reviews"
            >
            <select class="rounded-md mx-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-none p-1"
            wire:model.live="assessment_type">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <div class="text-white flex flex-col ">
                <button type="submit" class=" rounded-md mx-1 mb-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-none p-1">New Asessment</button>

                @error('title')
                <ul>
                    {{ $message }}
                </ul>
                @enderror
                @error('instructions')
                <ul>
                    {{ $message }}
                </ul>
                @enderror
                @error('due_date')
                <ul>
                    {{ $message }}
                </ul>
                @enderror
                @error('course')
                <ul>
                    {{ $message }}
                </ul>
                @enderror
            </div>
        </div>
    </form>
    @endif
    @if($groups != null)
        <ul>
    @foreach($groups as $groupIndex => $group)
        <li>
            <span class="underline">
                Group {{$groupIndex+1}}
            </span>
            <ul class="p-2">
                @foreach($group as $userIndex => $user)
                    <li class="pl-2 flex flex-row justify-between hover:ring-2 ring-blue-500 rounded-md" >
                        <span>
                            {{$user['name']}}
                        </span>
                        <div class="pr-2">
                            <button wire:click="moveUserUp({{$groupIndex}}, {{$userIndex}})">↑</button>
                            <button wire:click="moveUserDown({{$groupIndex}}, {{$userIndex}})">↓</button>
                        </div>
                    </li>
                @endforeach
            </ul>
        <hr/>
        </li>
    @endforeach
        </ul>
    @endif
</div>
</div>

