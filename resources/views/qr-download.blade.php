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
            <a href="/" class="print-button uppercase text-sm font-bold px-4 py-2 rounded-lg text-white bg-gray-500">
                Back to home
            </a>
            <button onclick="window.print()" class="print-button uppercase text-sm font-bold px-4 py-2 rounded-lg text-white bg-gray-500">
                Print
            </button>
            <a href="#" target="_blank" id="downloadbutton" download class="print-button uppercase text-sm font-bold px-4 py-2 rounded-lg text-white bg-green-500">
                Download
            </a>
        </div>
    </div>
    <div class="text-center">
        <div style="font-weight: 900">
            We kindly request that you adhere to the following instructions to ensure the security and privacy of the information contained within the QR code:
        </div>
        <ol>
            <li>
             <b> Confidentiality:</b> The QR code you have received is meant exclusively for your use and should not be shared with others, including friends, family, or colleagues.
            </li>
            <li>
                <b> Unauthorized Access: </b> Sharing the QR code with unauthorized individuals can lead to potential data breaches or misuse of sensitive information. To prevent any unintended consequences, please refrain from distributing it.
            </li>
            <li>
              <b>  Personal Usage Only:</b> The QR code is intended for personal use and should not be used for any commercial or promotional purposes without explicit permission.
            </li>
            <li>
                <b>   Dispose Securely: </b>After the purpose of the QR code has been fulfilled, please dispose of any physical or digital copies in a secure manner, ensuring it cannot be recovered or accessed by others.
            </li>
            <li>
                <b> Informing Concerns: </b>If you suspect that the QR code has been shared with others or compromised in any way, please notify us immediately, so appropriate measures can be taken to protect the data.
            </li>
        </ol>
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
