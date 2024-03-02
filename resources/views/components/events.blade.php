<div class="mx-3 md:mx-auto md:w-2/3 py-8 h-screen overflow-y-auto">
    <h1 class="text-xl uppercase md:text-2xl md:text-left text-yellow-900 ">Events & Announcements</h1>
    @foreach (\App\Models\Event::where('start', '>', \Carbon\Carbon::now())->latest()->get() as $event)
        <div class="shadow-lg bg-white p-2 rounded-md my-2 text-gray-900">
            <div>
                {{$event->title}} @ {{ $event->venue}}
            </div>
            <div class="text-gray-700 text-xs font-thin">
                - {{$event->start->format('M-d-Y, H:i A')}} - {{$event->end->format('M-d-Y, H:i A')}}
            </div>
        </div>
    @endforeach
</div>
