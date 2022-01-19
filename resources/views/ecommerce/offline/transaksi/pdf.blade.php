<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Transaksi</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
    <style>
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
            position: relative;
            width: 7cm;
            height: 12cm;
            margin: 0 auto;
            margin-left: -30px;
            color: #001028;
            background: #FFFFFF;
            font-size: 7px;
            font-family: monospace;
        }

        header {
            /* padding: 10px 0; */
            margin-bottom: 5px;
        }

        #logo {
            text-align: center;
            padding-left: 90px;
            display: inline-block;
            font-size: 7px;
            /* margin-bottom: 10px; */
        }

        #logo img {
            width: 15px;

        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            /* font-size: 2.4em; */
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {

            text-align: left;
            margin-top: 10px;
            /* font-size: 0.8em; */
        }

        #project span {
            /* color: #5D6975; */

            /* width: 52px; */
            margin-right: 10px;
            display: inline-block;
            /* font-size: 0.8em; */
            margin-top: 1px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        hr {
            border: none;
            border-top: 1px dotted rgb(0, 0, 0);
            color: #fff;
            background-color: #fff;
            height: 1px;
            width: 100%;
            margin-right: 20px;
        }

        table {
            width: 107%;
            /* border-collapse: collapse; */
            border-spacing: 0;
            margin-bottom: 20px;
            /* padding-right: 5px; */

        }

        table tr:nth-child(2n-1) td {
            /* background: #F5F5F5; */
        }

        /* table th,
        table td {
            text-align: center;
        } */

        table th {
            /* padding: 5px 20px; */
            color: #000000;
            /* border-bottom: 1px solid #C1CED9; */
            white-space: nowrap;
            font-weight: bold;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            /* padding: 20px; */
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            /* font-size: 1.2em; */
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #000000;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #000000;
            padding: 8px 0;
            text-align: center;
            margin-right: 18px;
        }

        .customization_text img {
            padding: 5px;
            display: block;
        }
    </style>
    <header class="clearfix">
        <div id="logo">
            <div id="photo" class="customization_text" >
                <img style="vertical-align:middle" src="{{public_path('assets/img/logo-hitam.png')}}" alt="">
                <span style="vertical-align:middle; font-size:8px; font-weight:bold">GARMENT</span>

            </div>
            {{-- <img src="{{public_path('assets/img/logo.png')}}">
            <p> GARMENT</p> --}}
        </div>
        <div style="padding-left:40px; margin-top:-15px;font-size:8px;">
            <h4>Jl. Raya Ir. Soekarno No. 45 Jakarta.</h4>
            <h4  style="padding-left:11px;">081223876689 - info@garment.com</h4>
        </div>
        <hr>
        <div id="project">
            <div style=" display: inline-block;">
                <span style='width: 60px; padding-right: 0; margin-right:0;'>Kode Transaksi </span>:
                {{$transaksi->kode_transaksi}}<br />
            </div>
            <br />
            <div style=" display: inline-block; padding-top: 6px;">
                <span style='width: 60px; padding-right: 0; margin-right:0;'>Tanggal </span>:
                {{$transaksi->tgl_transaksi}}<br />
            </div>
            <br />
            <div style=" display: inline-block;  padding-top: 4px;">
                <span style='width: 60px; padding-right: 0; margin-right:0;'>Store </span>: Offline<br />
            </div>


        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th style="text-align: left">Nama Produk</th>

                    <th style="text-align: left">Harga</th>
                    <th style="text-align: left; padding-right:23px">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi->detail_transaksi as $item)
                <tr>
                    <td style="text-align: left">
                        {{$item->produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}
                        x{{$item->jumlah}}
                    </td>

                    <td style="text-align: left">@rupiah($item->harga)</td>
                    <td style="text-align: left">@rupiah($item->total_harga)</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <hr>
        <div style="padding-bottom:14px">
            <table>
                <tbody>
                    <tr>
                        <td style="text-align:left; font-weight:bold">Total</td>
                        <td style="text-align:left; padding-left:135px; font-weight:bold">@rupiah($transaksi->total_harga)</td>
                    </tr>
                    <tr>
                        <td style="text-align:left; font-weight:bold">Potongan</td>
                        <td style="text-align:left; padding-left:135px; font-weight:bold">-</td>
                    </tr>
                    <tr>
                        <td style="text-align:left; font-weight:bold">Bayar</td>
                        <td style="text-align:left; padding-left:135px; font-weight:bold">@rupiah($transaksi->bayar)</td>
                    </tr>
                    <tr>
                        <td style="text-align:left; font-weight:bold">Kembalian</td>
                        <td style="text-align:left; padding-left:135px; font-weight:bold">@rupiah($transaksi->kembalian)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        Terima kasih sudah berbelanja di toko kami.
        Barang yang sudah dibeli dan sudah tercatat di struk tidak dapat ditukar atau dikembalikan.
    </footer>
</body>

</html>
