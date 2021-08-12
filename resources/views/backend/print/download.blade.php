<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Production</title>
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
            /* border-top: 1px solid #5D6975; */
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            /* font-size: 2.4em; */
            /* line-height: 1.4em; */
            font-weight: bold;
            text-align: center;
            margin: 0 0 20px 0;

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
            /* text-align: center; */
            font-size: 1.2em;
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
            /* text-align: center; */
        }

        table td.service,
        table td.desc {
            vertical-align: top;
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

        .center {
            text-align: center;
        }

        .customization_text img {
            background: #007AFF;
            padding: 5px;
            border-radius: 110%;
            display: block;
            /* width: 40px;
            height: 40px; */
        }

        .pagenum:before {
        content: counter(page);
        }

        .btn {
        background-color: #007AFF;
        border: none;
        color: white;
        padding: 12px 16px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
        border-radius: 40%;
        }
    </style>
</head>

@forelse ($data as $key => $item)

<body>

    <div id="photo" class="customization_text" style="text-align: right">
        <img style="vertical-align:middle" src="{{public_path('assets/icon/t-shirt-fill.png')}}" alt="">
        <span style="vertical-align:middle; font-size:25px; font-weight:bold">GARMENT</span>
    </div>
    <hr>
    <button class="btn"><i class="fa fa-home"></i> Home</button>
    <main>
        <table>

            <tbody>

            </tbody>

        </table>

    </main>

    <h3 style="text-align: right; position: fixed;left: 0;bottom: 0;" class="pagenum"></h3>
</body>

@empty

@endforelse

</html>
