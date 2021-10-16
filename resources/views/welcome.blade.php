<x-layout>
    <div id="alert_message_success" class="hidden fixed bg-yellow-300 text-green-700 p-4 bottom-5 right-5 justify-around shadow-lg flex items-center">

        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#047857"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>
        Message Sent!
    </div>
    <script>
        @if(session('success'))
            let check = document.getElementById('alert_message_success');
            check.classList.remove('hidden');
            setTimeout(() => {
                check.classList.add('hidden');
            }, 3000);
        @endif
    </script>
    <x-header></x-header>
    <x-banner></x-banner>
    <x-intro></x-intro>
    <x-about></x-about>
    <x-events></x-events>
    <x-contact></x-contact>
    <x-footer></x-footer>
</x-layout>
