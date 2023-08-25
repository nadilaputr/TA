<!DOCTYPE html>
<html lang="en">

<style>
    table,
    th,
    td {
        border: 2px solid black;

    }

    td {
        padding-left: 4px;
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
                        'a4-height': '125mm',
                    },
                },
            },
            variants: {},
            plugins: [],
        }
    </script>
</head>

<body class="bg-gray-300">
    <div class="font-serif py-4 px-10 bg-white mx-auto" style="width: 210mm; height: 125mm;">
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
                    <td style="width: 25%;"> {{ $disposisi->surat_masuk->id }}</td>

                    <td class="font-bold text-left" style=" width: 25%;">Tkt. Keamanan</td>
                    <td style="width: 25%;"></td>
                </tr>
                <tr>
                    <td class="font-bold text-left">Tgl. Penerimaan</td>
                    <td style="width: 25%;"> {{$dateFormat->from($disposisi->tanggal_disposisi)  }}</td>

                    <td class="font-bold text-left" style=" width: 25%;">Tgl. Penyelesaian</td>
                    <td style="width: 25%;"></td>
                </tr>

                <tr>
                    <td colspan="2" class="font-bold text-left">Tanggal dari Nomor Surat</td>
                    <td colspan="2">{{ $disposisi->surat_masuk->tanggal_surat }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="font-bold text-left">Dari</td>
                    <td colspan="2">{{  $disposisi->surat_masuk->asal_surat  }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="font-bold text-left">Ringkasan Isi</td>
                    <td colspan="2">{{ $disposisi->surat_masuk->perihal }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="font-bold text-left" >Lampiran</td>
                    <td colspan="2">{{ $disposisi->surat_masuk->lampiran }}</td>
                </tr>
                <tr>
                    <th  class="font-bold" style=" vertical-align: top;">Diteruskan Kepada :</th>
                    <th colspan="2"class="font-bold" style=" vertical-align: top;">Disposisi :</th>
                    <th class="font-bold" style=" vertical-align: top;">Paraf :</th>
                </tr>
                <tr>
                    <td class="text-center" style="height: 100px; ">{{  $disposisi->bidang->bidang  }}</td>
                    <td colspan="2" class="text-center" style="height: 100px;">{{ $disposisi->catatan }}</td>
                    <td class="font-bold" style="height: 100px; vertical-align: top;"></td>
                </tr>
            </table>
        </main>
    </div>
</body>

</html>
