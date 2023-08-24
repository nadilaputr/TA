<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Disposisi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    spacing: {
                        'a4-width': '210mm',
                        'a4-height': '297mm',
                    },
                },
            },
            variants: {},
            plugins: [],
        }
    </script>
</head>

<body class="bg-gray-300">
    <div class="font-serif py-4 px-10 bg-white mx-auto" style="width: 210mm; height: 297mm;">
        <header class="text-center flex justify-center">
            <div>
                <img src="{{ asset('images/logo.png') }}" class="w-36" alt="Logo">
            </div>
            <div>
                <h1 class="">PEMERINTAH PROVINSI KALIMANTAN BARAT</h1>
                <h1 class="font-bold text-xl">DINAS PERINDUSTRIAN, PERDAGANGAN, ENERGI</h1>
                <h1 class="font-bold text-xl">DAN SUMBER DAYA MINERAL</h1>
                <h1>Jalan Letjen Sutoyo</h1>
                <h1>Email: disperindag-esdm@kalbarprov.go.id Website: disperindagesdm.kalbarprov.go.id</h1>
                <h1>Pontianak</h1>
            </div>
        </header>

        <h2 class="text-right -mt-6">Kode Pos 78121</h2>
        <div class="w-full bg-black h-1 mt-1"></div>
        <div class="w-full bg-black" style="margin-top: 1pt; height: 2px"></div>

        <main class="mt-3">
            <h1 class="text-center text-lg font-semibold">LEMBAR DISPOSISI</h1>

            <table class="border-collapse border border-black w-full mt-3">

            </table>
        </main>
    </div>
</body>

</html>
