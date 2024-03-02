<div class="text-center  bg-white py-8 text-green-900 md:py-24 h-screen flex items-center">
    <div class="md:w-2/3 md:mx-auto">
        <h2 class="font-thin text-xl uppercase md:text-3xl md:text-left mb-4">
            About Us
        </h2>
        <img src="{{nova_get_setting('about_image') ? '/storage/'.nova_get_setting('about_image') : 'https://via.placeholder.com/150'}}" alt="" class="w-full h-40   object-cover">
            
        <p class=" text-lg font-thin mt-4">
            @if (!nova_get_setting('about_us'))
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. A blanditiis pariatur porro cupiditate beatae nostrum ea eveniet aliquam rem, magni repudiandae repellat ad, alias minus dolorem fuga odio vero recusandae.
            @else
                {{nova_get_setting('about_us')}}
            @endif
        </p>
    </div>
</div>
