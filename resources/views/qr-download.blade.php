<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <script src="/vendor/qrcode/jquery.min.js"></script>
    <script src="/vendor/qrcode/qrcode.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
   @if (request()->has('register') && request()->register == 'success')
   <div class="text-center py-2 text-2xl bg-green-100 text-green-900">
        Success Registration! please Keep the <span class="font-bold">QRCODE</span> below.
    </div>
   @endif
    <div class="flex justify-center flex-col items-center mt-4">
        <div id="qrcode"></div>
        <div class="mt-4">
            <button onclick="/" class="print-button uppercase text-sm font-bold px-4 py-2 rounded-lg text-white bg-gray-500">
                Back to home
            </button>
            <button onclick="window.print()" class="print-button uppercase text-sm font-bold px-4 py-2 rounded-lg text-white bg-gray-500">
                Print
            </button>
            <a href="#" target="_blank" id="downloadbutton" download class="print-button uppercase text-sm font-bold px-4 py-2 rounded-lg text-white bg-green-500">
                Download
            </a>
        </div>
    </div>
    <script type="text/javascript">
        let qrcode = document.getElementById("qrcode");
        let downloadButton = document.getElementById("downloadbutton");
        new QRCode(qrcode, "{{$member->url}}");


        //to download
        html2canvas(qrcode)
            .then(function(canvas){
                downloadButton.download = "qr-{{$member->reference_number}}";
                downloadButton.href = canvas.toDataURL();
            })
    </script>
</body>
</html>
