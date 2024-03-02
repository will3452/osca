{{-- intro --}}
<div class="text-center mt-8 text-lg font-thin text-gray-900 h-screen flex items-center">
    <div class="mx-auto  md:w-2/3 md:py-8 md:text-2xl first-letter:text-6xl first-letter:font-bold">
        @if (!nova_get_setting('intro'))
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sed beatae iste quisquam quam iusto consequuntur nostrum expedita necessitatibus commodi rem.
        @else
        {{ nova_get_setting('intro')}}
        @endif
    </div>
</div>
{{-- end intro --}}
