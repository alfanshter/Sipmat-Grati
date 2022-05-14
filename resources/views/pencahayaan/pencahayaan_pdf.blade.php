<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>

<head>

    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <title></title>
    <meta name="generator" content="https://conversiontools.io" />
    <meta name="author" content="mukhammad alfan" />
    <meta name="created" content="2022-04-13T13:59:55" />
    <meta name="changedby" content="mukhammad alfan" />
    <meta name="changed" content="2022-04-13T14:00:09" />
    <meta name="AppVersion" content="16.0300" />
    <meta name="DocSecurity" content="0" />
    <meta name="HyperlinksChanged" content="false" />
    <meta name="LinksUpToDate" content="false" />
    <meta name="ScaleCrop" content="false" />
    <meta name="ShareDoc" content="false" />

    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 7px 20px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 7px 20px;
            word-break: normal;
        }

        .tg .tg-9wq8 {
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-b6io {
            border-color: inherit;
            font-family: Arial, Helvetica, sans-serif !important;
            text-align: center;
            vertical-align: middle
        }


        .tg .tg-wk8r {
            background-color: #ffffff;
            border-color: #ffffff;
            text-align: center;
            vertical-align: top
        }
    </style>

</head>

<body>
    <h1 style="text-align: center">FORM PENGECEKAN PENCAHAYAAN</h1>
    <table class="tg">
        <thead>
            <tr>
                <th class="tg-b6io" colspan="5" rowspan="2">NO</th>
                <th class="tg-b6io" rowspan="2">LOKASI</th>
                <th class="tg-b6io" rowspan="2">KODE</th>
                <th class="tg-b6io" rowspan="2">SHIFT</th>
                <th class="tg-9wq8" rowspan="2">TANGGAL<br> PENGUKURAN</th>
                <th class="tg-b6io" colspan="4">HASIL PENGUKURAN (LUX)</th>
                <th class="tg-b6io" rowspan="2">NILAI MINIMUM (LUX)</th>
                <th class="tg-b6io" rowspan="2">SUMBER PENCAHAYAAN        (A= ALAMI, B= BUATAN)</th>
                <th class="tg-b6io" rowspan="2">KETERANGAN TAMBAHAN</th>
            </tr>
            <tr>
                <th class="tg-b6io">X1</th>
                <th class="tg-b6io">X2</th>
                <th class="tg-b6io">X3</th>
                <th class="tg-b6io">RATA-RATA</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td class="tg-b6io" colspan="5">{{$loop->iteration}}</td>
                <td class="tg-b6io">{{$item->pencahayaan->lokasi}}</td>
                <td class="tg-b6io">{{$item->pencahayaan->kode}}</td>
                <td class="tg-b6io">{{$item->shift}}</td>
                <td class="tg-9wq8">{{$item->tanggal_cek}}</td>
                <td class="tg-b6io">{{$item->lux1}}</td>
                <td class="tg-b6io">{{$item->lux2}}</td>
                <td class="tg-b6io">{{$item->lux3}}</td>
                <td class="tg-b6io">{{$item->luxrata2}}</td>
                <td class="tg-b6io">{{$item->nilai_minimum_lux}}</td>
                <td class="tg-b6io">{{$item->sumber_pencahayaan}}</td>
                <td class="tg-b6io">{{$item->keterangan}}</td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
    <p><i><b>* Dasar Hukum : PERMEN NO. 7/1964 tentang Syarat Kesehatan, Kebersihan, serta Penerangan dalam Tempat Kerja</b></i></p>
    <!-- ************************************************************************** -->
    <br><br>

    <table class="tg">
        <thead>
            <tr>
                <td class="tg-wk8r" rowspan="4">Mengetahui<br><br>{{$jabatan}}<br><br><br>
                    <img src="{{public_path('storage/ttd-pencahayaan/pencahayaan-ttd.png')}}" alt="Image" width="100" height="100">
                    <br>{{$nama}}
                </td>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
        </thead>
    </table>
</body>

</html>