<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-300">
   <div style="width:210mm !important;" class="mx-auto bg-white mt-8 p-8">
        <div class="flex items-start justify-between text-right">
            <img src="{{$member->picture == null ? '/storage/'.$member->picture : 'https://via.placeholder.com/150'}}"
            alt=""
            class="w-32 h-32 object-fit"
            />
            <div class="ml-8 text-lg font-bold uppercase">
                <div class="mt-2">
                    <span class="text-sm">Reference No.:</span>
                    <div>
                        {{$member->reference_number}}
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm">Name:</span>
                    <div>
                        {{$member->first_name}} {{$member->middle_name}} {{$member->last_name}}
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm">Birthdate:</span>
                    <div>
                        {{$member->birthdate->format('M/D/Y')}}
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm">Age:</span>
                    <div>
                        {{\Carbon\Carbon::parse($member->birthdate)->age}} years old
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-sm">Date Of Membership:</span>
                    <div>
                        {{$member->date_of_membership->format('M/D/Y')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="text-lg font-bold uppercase">
            <div class="text-sm">
                Full Address
            </div>
            {{$member->house_no}}, {{$member->street}}, {{$member->barangay}}
        </div>
        <div class="text-lg font-bold uppercase mt-4">
            <div class="text-sm">
                Occupation
            </div>
            {{$member->occupation}} -  {{$member->position}}
        </div>
        <div class="flex">
            <div class="text-sm font-bold uppercase mt-4 w-1/2">
                <div class="text-sm">
                    Family
                </div>
                @foreach ($member->families as $family)
                    <li>
                        {{$family->name}} - {{$family->relation}}
                    </li>
                @endforeach
            </div>
            <div class="text-sm font-bold uppercase mt-4 w-1/2">
                <div class="text-sm">
                    Association
                </div>
                <ul>
                    @foreach ($member->associations as $assoc)
                        <li class="p-2 shadow">
                            <div>
                                {{$assoc->name}} - {{$assoc->position}}
                            </div>
                            <div class="text-xs">
                                {{$assoc->street}} - {{$assoc->barangay}} {{$assoc->city}} ({{$assoc->officer_date_elected->format('M d,Y')}})
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

   </div>
</body>
</html>
