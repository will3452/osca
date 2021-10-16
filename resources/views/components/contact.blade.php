<div class="bg-green-700 text-white text-center py-8 ">
    <div class="md:w-2/3 md:mx-auto">
        <h1 class="text-xl font-bold uppercase md:text-2xl md:text-left px-4">
            Message Us
        </h1>
        <form action="{{route('leave.message')}}" method="post" class="px-4 py-2 mt-4">
            @csrf
            <div class="mb-2">
                <label for="" class="block text-left font-bold">Email</label>
                <input type="email" required name="email" class="w-full my-2 p-2 text-gray-900" placeholder="juan@example.com">
            </div>
            <div class="mb-2">
                <label for="" class="block text-left font-bold">Message</label>
                <textarea maxlength="200" name="message" placeholder="Aa" class="w-full mt-2 p-2 text-gray-900"></textarea>
                <small class="block text-left">Maximum Character 200 only.</small>
            </div>
            <div>
                <button class="bg-yellow-300 text-yellow-900 px-4 py-2 font-bold uppercase ">
                    Send
                </button>
            </div>
        </form>
    </div>
</div>
