<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Generation</title>
    <style>
        body,html {
            margin: 0;
        }
        .my {
            margin-top:10px;
            margin-right: 20px;
        }

        #control form{
            display: flex;
            justify-content: center;
        }

        table {
            width:100vw;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th {
            text-align: left;
        }
        th, td {
            border: 1px solid #000;
            padding:4px;
        }

        @media print {
            #control {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div id="control">
        <form action="/generate-report">
            <div class="my">
                <label for="">Registered From:</label>
                <input type="date" value="{{request()->from}}" name="from" required>
                <label for="">To:</label>
                <input type="date" value="{{request()->to}}" name="to" required>
            </div>
            <div class="my">
                <label for="">Age From:</label>
                <input type="number" value="{{request()->from_age}}" name="from_age" required>
                <label for="">To:</label>
                <input type="number" value="{{request()->to_age}}" name="to_age" required>
            </div>
            @if (is_null(auth()->user()->barangay))
            <div class="my">
                <label>Barangay</label>
                <select name="barangay" id="">
                    <option value="">All</option>
                    @foreach (\App\Models\Barangay::get() as $item)
                        <option value="{{$item->name}}" {{$itme->name == request()->barangay ? 'selected' :''}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="my">
                <button>Load</button>
                <button type="button" onclick="window.print()">print</button>
            </div>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Age
                </th>
                <th>
                    Birthdate
                </th>
                <th>
                    Date Of membership
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>
                        {{$item->last_name}}, {{$item->first_name}} {{$item->middle_name}}
                    </td>
                    <td>
                        {{$item->birthdate->age}}
                    </td>
                    <td>
                        {{$item->birthdate->format('m/d/Y')}}
                    </td>
                    <td>
                        {{$item->date_of_membership->format('m/d/Y')}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
