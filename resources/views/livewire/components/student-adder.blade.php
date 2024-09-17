
<div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
    <div class=" p-2 pt-2 rounded-md">
    <ul class="">
        @foreach($students as $student)
            <li wire:click="toggleStudent({{$student}})" wire:key="{{ $student->id }}" class="flex flex-row flex-grow rounded-md my-2 group cursor-pointer text-sm bg-purple-400">
                {{ $student['name'] }}
            </li>
        @endforeach
    </ul>
    </div>
</div>
