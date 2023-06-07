<!DOCTYPE html>
<html>
<head>
    <title>OSCA ID Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        @media print {
               .noprint {
                  visibility: hidden;
               }
            }

        .card {
            width: 400px;
            height: 250px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header {
            text-align: center;
            margin-bottom: 0px;
        }

        .photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
            background-color: #ccc;
            background-size: cover;
            background-image: url('/storage/{{$member->picture}}')
            background-position: center;
        }

        .info {
            text-align: center;
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h2>OSCA ID Card</h2>
        </div>
        <img  src="/storage/{{$member->picture}}" alt="" style="margin-bottom: 1em; width:60px; height:60px; ">
        <div class="info">
            <span class="label">Name:</span> {{$member->last_name}}, {{$member->first_name}} {{$member->middle_name[0]}}
        </div>
        <div class="info">
            <span class="label">Date of Birth:</span> {{ $member->birthdate->format('M d, Y') }}
        </div>
        <div class="info">
            <span class="label">Address:</span> {{ $member->house_no}} {{$member->street}} {{ $member->barangay }}
        </div>
        <div class="info">
            <span class="label">ID Number:</span> {{$member->reference_number}}
        </div>
    </div>
    <button onclick="window.print()" class="noprint">print</button>
</body>
</html>
