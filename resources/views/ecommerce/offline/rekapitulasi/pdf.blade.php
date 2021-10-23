<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
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
            width: 18cm;
            height: 29.7cm;
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

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
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

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
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
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
    <header class="clearfix">
        <div id="logo">
            <img src="{{public_path('assets/img/logo.png')}}">
        </div>
        <h1>{{$transaksi->kode_transaksi}}</h1>
        <div id="project">

            <div><h4>Tanggal Transaksi:  {{$transaksi->tgl_transaksi}}</h4></div>

          </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi->detail_transaksi as $item)
                <tr>
                    <td style="text-align: center">{{$loop->iteration}}</td>
                    <td style="text-align: center">{{$item->produk->kode_produk}}</td>
                    <td style="text-align: center">{{$item->produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}
                    </td>
                    <td style="text-align: center">{{$item->jumlah}}</td>
                    <td>@rupiah($item->harga)</td>
                    <td>@rupiah($item->total_harga)</td>
                </tr>
                @empty

                @endforelse
                <tr>
                    <td colspan="5">Total</td>
                    <td class="total">@rupiah($transaksi->total_harga)</td>
                </tr>
                <tr>
                    <td colspan="5">Bayar</td>
                    <td class="total">@rupiah($transaksi->bayar)</td>
                </tr>
                <tr>
                    <td colspan="5">Kembalian</td>
                    <td class="total">@rupiah($transaksi->kembalian)</td>
                </tr>

            </tbody>
        </table>

    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>
