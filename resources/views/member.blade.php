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
   <div style="width:210mm !important; height: 297mm !important;" class="mx-auto bg-white mt-8">
        <img src="/storage/{{$member->picture}}" alt="">
   </div>
</body>
</html>
