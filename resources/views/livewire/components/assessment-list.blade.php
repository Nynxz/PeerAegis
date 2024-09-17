<div class=" m-2 p-2 max-h-fit overflow-y-scroll overflow-x-clip">
    <div class=" p-2 pt-2 rounded-md ">
    <ul class="">
        @foreach($assessments as $assessment)
            <li class="flex flex-row flex-grow rounded-md my-2 group cursor-pointer text-sm bg-purple-400"
                wire:click="selectAssessment({{$assessment}})">
                {{ $assessment->title }}
            </li>
        @endforeach
    </ul>
</div>
</div>
