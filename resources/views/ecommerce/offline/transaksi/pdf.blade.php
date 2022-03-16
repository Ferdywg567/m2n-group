<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Transaksi</title>
    <link rel="stylesheet" href="style.css" media="all" />
    {{-- <link rel="stylesheet" href="{{ public_path('ecommerce/assets/css/vendor/bootstrap.min.css') }}"> --}}
</head>

<body>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid black;
            /* margin-bottom: 20px; */
            /* padding-right: 20px; */
        }

        table tr:nth-child(2n-1) td {
            /* background: #F5F5F5; */
        }

        table th {
            padding: 5px 15px;
            /* color: #5D6975; */
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
            border: 1px solid black;
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

        #logo img {
            width: 90px;
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
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
            font-size: 10px;
            font-family: monospace;
        }

        table td {
            white-space: nowrap;
            padding-bottom: 10px;
            padding-top: 10px;
            /* border: 1px solid black; */
            border-right: solid 1px black;
            border-left: solid 1px black;
        }



        #logo {
            text-align: center;
            /* padding-left: 90px; */
            display: inline-block;
            font-size: 7px;
            /* margin-bottom: 10px; */
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
            /* border-top: 1px solid #C1CED9; */
        }

    </style>

    <main>
        <header class="clearfix">

            <br>
            <div id="company" class="clearfix">
                <div>
                    Date...........
                </div>
                <div style="padding-right: 24px">Kepada Yth.</div>
                <div>
                    Bapak/Ibu......
                </div>
                <div style="text-transform: uppercase;">
                    ...............
                </div>
                <div style="text-transform: uppercase;">
                    ...............
                </div>
            </div>
            <div id="project">
                <div> <b>PT. GARMENT INDONESIA</b></div>
                <div> Jl. Raya Ir. Soekarno No. 45 Jakarta</div>
                <div>Telp. 081223876689</div>
                <div>info@garment.com</div>

            </div>
        </header>
        <div style="text-align: right; padding-top:12px">Kode Transaksi : <b>{{ $transaksi->kode_transaksi }}</b>
        </div>
        <table class="table" style="padding-top: 10px">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Size</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi->detail_transaksi as $item)
                    <tr class="center">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $item->produk->nama_produk }}
                        </td>
                        <td class="center">{{ $item->ukuran }}</td>
                        <td class="center">{{ $item->jumlah }}</td>
                        <td>@rupiah($item->harga)</td>
                        <td>@rupiah($item->total_harga)</td>
                    </tr>
                @empty
                @endforelse
            </tbody>
            <tfoot style="  border: 1px solid black;">
                <tr>
                    <td colspan="5" class="center"><b>Total Harga</b></td>
                    <td class="center"><b>@rupiah($transaksi->detail_transaksi->sum('total_harga'))</b></td>
                </tr>
            </tfoot>


            {{-- <div>
                <div style="padding-top: 10px; text-align:left">Hormat Kami,</div>
                <div style="padding-top: 35px; text-align:left"><b>PT. Garment</b></div>
            </div> --}}
        </table>
        <table style="border: none; margin-top:5px">
            <tr style="border: none">
                <td style="border: none">
                    <div style="padding-top: 10px; text-align:left">Hormat Kami,</div>
                    <div style="padding-top: 35px; text-align:left"><b>PT. Garment</b></div>
                </td>
                <td style="border: none">
                    <div style="padding-top: 10px; text-align:left">Tanda Terima,</div>
                    <div style="padding-top: 35px; text-align:left"><b>............</b></div>
                </td>
                <td style="border: solid 1px black; border-radius: 10px; width:40%">
                    <p style="margin: 0">BCA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 2481293792</p>
                    <p style="margin: 0">Mandiri &nbsp;: 121 000 5051853</p>
                    <p style="margin: 0">BRI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 200 601 000 954504</p>
                    <p style="margin: 0">BNI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 017 521 6421</p>
                    <p style="margin-bottom: 0; text-align:center"><b>a/n Suryadi</b></p>
                </td>
            </tr>
        </table>
        {{-- <footer>

            <div style="padding-top: 10px; text-align:right">Hormat Kami, </div>
            <div style="padding-top: 35px; text-align:right">PT. Garment </div>

        </footer> --}}
    </main>

</body>

</html>
