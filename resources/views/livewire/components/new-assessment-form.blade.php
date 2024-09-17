<div class=" p-2 pt-2 rounded-md ">
<div class=" p-2 overflow-clip">
    @if($course && Gate::allows('createAssessment', $course))
            Can create!
    @if($error)
        {{$error}}
    @endif
    <form wire:submit="newAssessment" class=" pt-8 gap-2 rounded-md text-2xl font-bold h-min text-black w-full flex-grow">
        <div class="flex flex-col gap-2 flex-grow p-4">
            <input type="text" wire:model="title" name="title" for="title" class=" rounded-md min-w-0 w-full"
                   placeholder="Title">
            <input type="text" wire:model="instructions" name="instructions" for="instructions"
                   class=" rounded-md min-w-0 w-full"
                   placeholder="Instructions">
            <input type="datetime-local" wire:model="due_date" name="due_date" for="due_date"
                   class=" rounded-md min-w-0 w-full"
                   placeholder="Date">
            <div class="text-white flex flex-col ">

                <button type="submit">New Asessment</button>

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

</div>
</div>

