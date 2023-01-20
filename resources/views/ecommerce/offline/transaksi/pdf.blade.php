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
            font-size: 1rem;
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

        body {
            /* position: relative; */
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            /* font-size: 1rem; */
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

        @page {
            /* size: 359px 415px; */
            size: A5 landscape;
            margin: 20px;
        }
        table.no-white-space tr td:first-child {
            width: 10%;
        }

        table.table-data {
            border-spacing: 30px 0;
        }
        html {
            font-size: 10px;
        }
        body {
            margin: 0px;
        }

    </style>
    <table style="width: 100%">
        <tr>
            <td>
                <table>
                    <tr>
                        <td style="vertical-align: top">
                            <img src="{{ public_path('/assets/img/Push & Pull Logo.png') }}" width="100%" alt="" srcset="">
                            <br>
                            <span style="font-size: 1.1rem; position: relative; left: 1.5px;"><b>Blok B Lt. Ground Los E No. 100 - 101</b></span>
                        </td>
                        <td style="text-align: right; vertical-align: top">
                            <div style="margin-top: 0rem">
                                <p style="margin: 0">
                                    <b>Hubungi Kami:</b>
                                </p>
                                <p style="margin: 0; padding: .1rem 0;">
                                    0812-0780-9972/0815-3460-5040 
                                    <img style="position: relative; top: 1px" src="{{ public_path('/assets/img/whatsapp-line.png') }}" width="10vw" alt="" srcset="">
                                </p>
                                <p style="margin: 0">
                                    m2ngroup@outlook.co.id 
                                    <img style="position: relative; top: 1px" src="{{ public_path('/assets/img/mail-line.png') }}" width="10vw" alt="" srcset="">
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="no-white-space table-data" style="font-size: 1rem; margin-top: 1.1rem; margin-left: .5rem;">
                    <tr>
                        <td><b>Tanggal</b></td>
                        <td style="width: 1%"><b>:</b></td>
                        <td>{{ date('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <td><b>Nama Pelanggan</b></td>
                        <td style="width: 1%"><b>:</b></td>
                        <td>{{ $transaksi->nama }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top"><b>Alamat</b></td>
                        <td style="width: 1%; vertical-align: top"><b>:</b></td>
                        <td style="word-wrap: break-word; white-space:normal; vertical-align: top">{{ $transaksi->alamat }}</td>
                    </tr>
                    <tr>
                        <td><b>No. Hp</b></td>
                        <td style="width: 1%"><b>:</b></td>
                        <td>{{ $transaksi->no_hp }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <p style="font-size: 1.1rem; margin-top: .5rem; position: relative; left: 3.5px; margin: 0">
        <b>
            <span style="margin-right: 10px">
                No. Nota : {{ $transaksi->kode_transaksi }}
            </span>
            <span>
                Pembayaran : {{ $transaksi->pembayaran }}
            </span>
        </b>
    </p>
    <table class="table" style="padding-top: 2px; border:1px solid black">
        <thead style="border: 1px solid black">
            <tr>
                <th scope="col" style="border: 1px solid black; font-weight: bold; padding: 5px;">No</th>
                <th scope="col" style="border: 1px solid black; font-weight: bold; padding: 5px; width: 40%">Nama Barang</th>
                <th scope="col" style="border: 1px solid black; font-weight: bold; padding: 5px;">Ukuran</th>
                <th scope="col" style="border: 1px solid black; font-weight: bold; padding: 5px;">Qty</th>
                <th scope="col" style="border: 1px solid black; font-weight: bold; padding: 5px;">Harga/Lusin</th>
                <th scope="col" style="border: 1px solid black; font-weight: bold; padding: 5px;">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi->detail_transaksi as $item)
                <tr class="center">
                    <td style="border: 1px solid black; font-weight: bold">{{ $loop->iteration }}</td>
                    <td style="border: 1px solid black; text-align: left; padding: 0 20px;">
                        {{ $item->produk->nama_produk }}
                    </td>
                    <td class="center jarak" style="border: 1px solid black">{{ $item->ukuran }}</td>
                    <td class="center jarak" style="border: 1px solid black">{{ $item->jumlah }}</td>
                    <td style="border: 1px solid black; text-align:right; padding: 0 40px 0px 10px;">@rupiah($item->harga)</td>
                    <td style="border: 1px solid black; text-align:right; padding: 0 40px 0px 10px;">@rupiah($item->total_harga)</td>
                </tr>
            @empty
            @endforelse
        </tbody>
        <tfoot style="border: none !important">
            <tr>

                <td class="center" style="padding: 6px 0px;" colspan="5"><b>Jumlah</b></td>
                <td class="center" style="border:1px solid black; text-align: right; padding: 0 40px 0px 10px;">
                    <b style="font-weight: bolder">@rupiah($transaksi->detail_transaksi->sum('total_harga'))</b>
                </td>
            </tr>
        </tfoot>
    </table>
    <table style="border: none;">
        <tr style="border: none">
            <td style="border: none; width: 41.3%">
                <div style="padding-top: 10px; padding-left:50px; text-align:left"><b>Hormat Kami,</b></div>
                <div style="padding-top: 45px; padding-left:50px; text-align:left"><b>............</b></div>
            </td>
            <td style="border: none">
                <div style="padding-top: 10px; text-align:left"><b>Tanda Terima,</b></div>
                <div style="padding-top: 45px; text-align:left"><b>............</b></div>
            </td>

        </tr>
    </table>

</body>

</html>
