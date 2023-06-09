<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Transaksi</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table td,
        .table th {
            font-size: 7px;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }


        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #project {
            float: right;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 7px;
        }

        #company {
            float: left;
            text-align: left;
            padding-left: 30px;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        body {
            position: relative;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-size: 7px;
            font-family: monospace;
        }

        table td {
            white-space: nowrap;

        }

        .jarak {
            padding-bottom: 10px;
            padding-top: 10px;
        }



        #logo {
            text-align: center;
            display: inline-block;
            font-size: 7px;
        }

        #logo img {
            width: 55px;
            margin-top: 12px;
        }

        .center {
            text-align: center;
        }

        footer {
            width: 100%;
            position: absolute;
            bottom: 0;
        }

        @page {
            size: 359px 415px;

        }

    </style>

    <main>
        <header class="clearfix">
            <table style="white-space: nowrap">
                <tr>
                    <td>
                        <div style="padding-bottom: 30px; margin-right:-20px;">
                            <img style="float: left; " src="{{ public_path('/assets/img/M2N Kids Logo.png') }}"
                                width="50%" alt="" srcset="">
                        </div>
                    </td>
                    <td>
                        <div style="margin-left:-10px">
                            <p style="margin-bottom:-5px; margin-top:-10px;font-size:5px; text-align: right;">Hubungi
                                Kami:
                            </p>
                            <p style="font-size:5px; text-align: right;margin-bottom:-5px; padding-top:3px">
                                0812-0780-9972/0815-3460-5040
                            </p>
                            <p style="font-size:5px; text-align: right; padding-top:3px">m2ngroup@outlook.co.id</p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <img style="margin-top: -2px" src="{{ public_path('/assets/img/whatsapp-line.png') }}"
                                width="30%" alt="" srcset="">
                            <br>
                            <img style="margin-top: -1px" src="{{ public_path('/assets/img/mail-line.png') }}"
                                width="30%" alt="" srcset="">
                        </div>
                    </td>
                    <td>
                        <div style="margin-left: -6px">
                            <p style="margin-bottom:-5px; font-size:5px; text-align: left;">Tanggal
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:{{ date('Y-m-d') }}
                            </p>
                            <p style="font-size:5px; text-align: left;margin-bottom:-5px;padding-top:8px">Nama
                                Pelanggan:{{ $transaksi->nama }}</p>
                            <p style="font-size:5px; text-align: left;margin-bottom:-5px;padding-top:8px">Alamat
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:{{ $transaksi->alamat }}</p>
                            <p style="font-size:5px; text-align: left;margin-bottom:-5px;padding-top:8px">No. Hp
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:{{ $transaksi->no_hp }}</p>
                        </div>
                    </td>
                </tr>

            </table>
            <table style="margin-top: -20px;font-size:5px;">
                <tr>
                    <td>Blok B Lt. Ground Los E No. 100 - 101</td>
                </tr>

            </table>
            <table style="font-size:5px;padding-top:11px">
                <tr>
                    <td>
                        <div style="float: left; margin-right:-20px">
                            No. Nota : {{ $transaksi->kode_transaksi }}
                        </div>
                    </td>
                    <td>
                        <div style="padding-right: 200px;">
                            Pembayaran : {{ $transaksi->pembayaran }}</div>
                    </td>
                </tr>
            </table>
        </header>
        {{-- <div style="text-align: right; padding-top:12px">Kode Transaksi : <b>{{ $transaksi->kode_transaksi }}</b> --}}
        </div>
        <table class="table" style="padding-top: 10px; border:1px solid black">
            <thead style="border: 1px solid black">
                <tr>
                    <th scope="col" style="border: 1px solid black">No</th>
                    <th scope="col" style="border: 1px solid black">Nama Barang</th>
                    <th scope="col" style="border: 1px solid black">Ukuran</th>
                    <th scope="col" style="border: 1px solid black">Qty</th>
                    <th scope="col" style="border: 1px solid black">Harga/Lusin</th>
                    <th scope="col" style="border: 1px solid black">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi->detail_transaksi as $item)
                    <tr class="center">
                        <td style="border: 1px solid black">{{ $loop->iteration }}</td>
                        <td style="border: 1px solid black">
                            {{ $item->produk->nama_produk }}
                        </td>
                        <td class="center jarak" style="border: 1px solid black">{{ $item->ukuran }}</td>
                        <td class="center jarak" style="border: 1px solid black">{{ $item->jumlah }}</td>
                        <td style="border: 1px solid black">@rupiah($item->harga)</td>
                        <td style="border: 1px solid black">@rupiah($item->total_harga)</td>
                    </tr>
                @empty
                @endforelse
            </tbody>
            <tfoot style="border: none !important">
                <tr>

                    <td class="center jarak" colspan="5"><b>Jumlah</b></td>
                    <td class="center" style="border:1px solid black">
                        <b>@rupiah($transaksi->detail_transaksi->sum('total_harga'))</b>
                    </td>
                </tr>
            </tfoot>


            {{-- <div>
                <div style="padding-top: 10px; text-align:left">Hormat Kami,</div>
                <div style="padding-top: 35px; text-align:left"><b>PT. M2N Group</b></div>
            </div> --}}
        </table>
        <table style="border: none; margin-top:5px">
            <tr style="border: none">
                <td style="border: none">
                    <div style="padding-top: 10px; text-align:left">Hormat Kami,</div>
                    <div style="padding-top: 35px; text-align:left"><b>............</b></div>
                </td>
                <td style="border: none">
                    <div style="padding-top: 10px; text-align:left">Tanda Terima,</div>
                    <div style="padding-top: 35px; text-align:left"><b>............</b></div>
                </td>
                {{-- <td style="border: solid 1px black; border-radius: 10px; width:40%">
                    <p style="margin: 0">BCA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 2481293792</p>
                    <p style="margin: 0">Mandiri &nbsp;: 121 000 5051853</p>
                    <p style="margin: 0">BRI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 200 601 000 954504</p>
                    <p style="margin: 0">BNI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 017 521 6421</p>
                    <p style="margin-bottom: 0; text-align:center"><b>a/n Suryadi</b></p>
                </td> --}}
            </tr>
        </table>
        {{-- <footer>

            <div style="padding-top: 10px; text-align:right">Hormat Kami, </div>
            <div style="padding-top: 35px; text-align:right">PT. M2N Group </div>

        </footer> --}}
    </main>

</body>

</html>
