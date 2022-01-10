<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Label</title>
    <style>
        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 8cm;
            height: "{{ $height }}";
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        main {
            margin-right: 2% !important;
        }

        table th,
        table td {
            text-align: center;
            font-size: 1.2em;
            width: 188.97px !important;
            height: 75.59px !important;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>

<body>

    <main>
        @forelse ($cetak as $item)
            <table class="" style="margin-bottom: 10px">
                <tbody>
                    <tr>
                        <td>
                            <div style="font-size: 16px">
                                @rupiah($item->harga_promo)
                            </div>
                            {{ $item->nama_produk }}

                            <br>
                            <br>
                            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($item->kode_produk, 'C39', 3, 33) }}"
                                width="120" height="40" alt="" srcset="" style="margin-bottom: -10px">
                            <br>
                            {{ $item->kode_produk }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @empty
        @endforelse
    </main>

</body>

</html>