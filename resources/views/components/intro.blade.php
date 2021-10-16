{{-- intro --}}
<div class="text-center mt-8 text-lg italic font-bold text-gray-900">
    <div class="mx-auto md:w-2/3 md:py-8 md:text-2xl">
        @if (!nova_get_setting('intro'))
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sed beatae iste quisquam quam iusto consequuntur nostrum expedita necessitatibus commodi rem.
        @else
        {{ nova_get_setting('intro')}}
        @endif
    </div>
</div>
{{-- end intro --}}
