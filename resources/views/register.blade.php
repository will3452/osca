<x-layout>
    <x-header></x-header>
    <h1 class="text-center font-bold uppercase text-2xl">
        Membership Registration Form
    </h1>

    <form action="/register" method="POST" enctype="multipart/form-data" class="w-full md:w-8/12 mx-auto">
        @csrf
        <div class="mt-2 mb-3">
            <label class="w-full font-bold text-base uppercase block mt-4 mb-2 border-b-2 border-green-500">Name</label>
            <div class="flex justify-around">
                <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" required type="text" placeholder="First Name" name="first_name">
                <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" required type="text" placeholder="Middle Name" name="middle_name">
                <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" required type="text" placeholder="Last Name" name="last_name">
            </div>
        </div>
        <div class="mt-2 mb-3">
            <div>
                <div>
                    <label class="w-full font-bold text-base uppercase block">Birthdate</label>
                    <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" type="date" required name="birthdate">
                </div>
                <div>
                    <label class="w-full font-bold text-base uppercase block">Place Of Birth</label>
                    <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" type="text" required name="place_of_birth">
                </div>
            </div>
        </div>
        <div class="mt-2 mb-3">
            <label class="w-full font-bold text-base uppercase block mt-4 mb-2 border-b-2 border-green-500">
                Address
            </label>
            <div>
                <div>
                    <label class="w-full font-bold text-base uppercase block">House No.</label>
                    <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" type="text" required name="house_no">
                </div>
                <div>
                    <label class="w-full font-bold text-base uppercase block">Street</label>
                    <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" type="text" required name="street">
                </div>
                <div>
                    <label class="w-full font-bold text-base uppercase block">Barangay</label>
                    <select required name="barangay" id="" class="mr-2 w-full p-2 border-green-500 border-2 rounded">
                        @foreach (\App\Models\Barangay::get() as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-2 mb-3">
            <label class="w-full font-bold text-base uppercase block mt-4 mb-2 border-b-2 border-green-500">Occupation</label>
            <div>
                <div>
                    <label class="w-full font-bold text-base uppercase block">Description</label>
                    <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" type="text" required name="occupation">
                </div>
                <div>
                    <label class="w-full font-bold text-base uppercase block">Position</label>
                    <input class="mr-2 w-full p-2 border-green-500 border-2 rounded" type="text" required name="position">
                </div>
            </div>
        </div>
        <div>
            <label class="w-full font-bold text-base uppercase block">Upload Picture</label>
            <input required type="file" accept="image/*" name="picture">
        </div>
        <button class="block w-full  p-2 uppercase text-white mt-2 mb-3 text-center bg-green-500 font-bold rounded-3xl">
            Regsiter & Generate QRCODE
        </button>
    </form>

</x-layout>
