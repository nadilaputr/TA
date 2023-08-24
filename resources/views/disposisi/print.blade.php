<!DOCTYPE html>
<html lang="en">

<style>
    table,
    th,
    td {
        border: 2px solid black;
    }
</style>

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
                        'a4-height': '120mm',
                    },
                },
            },
            variants: {},
            plugins: [],
        }
    </script>
</head>

<body class="bg-gray-300">
    <div class="font-serif py-4 px-10 bg-white mx-auto" style="width: 210mm; height: 120mm;">
        <header class="text-center flex justify-center">
            {{-- <div>
                <img src="{{ asset('images/logo.png') }}" class="w-36" alt="Logo">
            </div> --}}
            <div>
                <h1 class="font-bold text-md">BADAN PUSAT STATISTIK</h1>
                <h1 class="font-bold text-md">PROVINSI KALIMANTAN BARAT</h1>
                <h1 class="text-sm">JALAN SULTAN SYAHRIR NO 24/42 PONTIANAK TELP:(0661) 736345, 788742, 748891 FAX(0661)
                    732184</h1>
                {{-- <h1 class="text-sm">TELP:(0661) 736345, 788742, 748891 FAX(0661) 732184</h1> --}}
            </div>
        </header>

        {{-- <h2 class="text-right -mt-6">Kode Pos 78121</h2> --}}
        <div class="w-full bg-black h-1 mt-1"></div>
        {{-- <div class="w-full bg-black" style="margin-top: 1pt; height: 2px"></div> --}}

        <main class="mt-1">
            {{-- <div class="w-full bg-black" style="margin-top: 3pt; height: 3px"></div>
            <h1 class="text-center text-md font-semibold">LEMBAR DISPOSISI</h1> --}}

            <table class="border-collapse border border-black w-full mt-3">

                <tr>
                    <td colspan="4" class="text-center text-md font-semibold">LEMBAR DISPOSISI</td>
                </tr>
                <tr>
                    <td class="font-bold text-left">Nomor Agenda</td>
                    <td style="width: 25%;"></td>

                    <td class="font-bold text-left" style=" width: 25%;">Tkt. Keamanan</td>
                    <td style="width: 25%;"></td>
                </tr>
                <tr>
                    <td class="font-bold text-left">Tgl. Penerimaan</td>
                    <td style="width: 25%;"></td>

                    <td class="font-bold text-left" style=" width: 25%;">Tgl. Penerimaan</td>
                    <td style="width: 25%;"></td>
                </tr>

                <tr>
                    <td colspan="2" class="font-bold text-left">Tanggal dari Nomor Surat</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2" class="font-bold text-left">Dari</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2" class="font-bold text-left">Ringkasan Isi</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2" class="font-bold text-left" ">Lampiran</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td  class="font-bold" style="height: 100px; vertical-align: top;">Disposisi :</td>
                    <td colspan="2"class="font-bold" style="height: 100px; vertical-align: top;">Diteruskan Kepada :</td>
                    <td class="font-bold" style="height: 100px; vertical-align: top;">Paraf :</td>
                </tr>
            </table>
        </main>
    </div>
</body>

</html>
