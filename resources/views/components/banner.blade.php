<div class="h-48 md:h-80 bg-red-200 relative flex flex-col items-center">
    <img class="object-cover h-full w-full" src="{{nova_get_setting('banner') ? '/storage/' . nova_get_setting('banner') : 'https://via.placeholder.com/728x400.png?text=please+upload+banner+image+to+admin'}}" alt="">
    <a href="/register" class="text-yellow-900 font-bold animate-bounce text-2xl uppercase tracking-wider bg-yellow-300 p-2 px-4 rounded-lg absolute -bottom-5">
        Register Now!
    </a>
</div>
