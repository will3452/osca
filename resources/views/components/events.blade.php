<div class="mx-3 md:mx-auto md:w-2/3 py-8">
    <h1 class="text-xl font-bold uppercase md:text-2xl md:text-left px-4 text-yellow-900 ">Events & Announcements</h1>
    @foreach (\App\Models\Event::latest()->get() as $event)
        <div class="border-l-4 border-yellow-900 bg-yellow-300 p-2 my-2 font-bold text-gray-900">
            <div>
                {{$event->title}}
            </div>
            <div class="text-gray-700 text-sm">
                - {{$event->start->format('M-d-Y, H:i A')}} - {{$event->end->format('M-d-Y, H:i A')}}
            </div>
        </div>
    @endforeach
</div>
