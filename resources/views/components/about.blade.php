<div class="text-center mt-4 bg-white py-8 text-green-900 md:py-24">
    <div class="md:w-2/3 md:mx-auto">
        <h2 class="font-bold text-xl uppercase md:text-3xl md:text-left ">
            About Us
        </h2>
        <div class="md:flex md:items-start md:text-left">
            <img src="{{nova_get_setting('about_image') ? '/storage/'.nova_get_setting('about_image') : 'https://via.placeholder.com/150'}}" alt="" class="object-cover w-1/3 mx-auto my-4 rounded md:mr-4">
            <p class="leading-0 md:p-2 md:text-left md:w-2/3">
                @if (!nova_get_setting('about_us'))
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. A blanditiis pariatur porro cupiditate beatae nostrum ea eveniet aliquam rem, magni repudiandae repellat ad, alias minus dolorem fuga odio vero recusandae.
                @else
                    {{nova_get_setting('about_us')}}
                @endif
            </p>
        </div>
    </div>
</div>
