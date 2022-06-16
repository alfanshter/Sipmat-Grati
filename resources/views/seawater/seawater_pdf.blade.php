<?php 
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>


<body>
    <style type="text/css">
        .tg {
            border-spacing: 0;
            border: 1px;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 9px 4px;
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
            padding: 9px 4px;
            word-break: normal;
        }

        .tg .tg-ieig {
            border-color: inherit;
            font-size: 12px;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-73a0 {
            border-color: inherit;
            font-size: 12px;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-9o1m {
            border-color: inherit;
            font-size: 12px;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-f4iu {
            border-color: inherit;
            font-size: 12px;
            text-align: center;
            vertical-align: top
        }
    </style>
    <table class="tg">

        <tr>
            <th class="tg-73a0" colspan="3" rowspan="3"></th>
            <th class="tg-9o1m" colspan="5">LOG SHEET TEST RUN</th>
        </tr>
        <tr>
            <th class="tg-9o1m" colspan="5">FIRE FIGHTING MOTOR DRIVEN &amp; DIESEL ENGINE SEA WATER</th>
        </tr>
        <tr>
            <th class="tg-9o1m">tanggal</th>
            <th class="tg-9o1m" colspan="4"><?php echo tgl_indo(date('Y-m-d')) ; ?></th>
        </tr>
        <tr>
            <td class="tg-9o1m" rowspan="2">NO</td>
            <td class="tg-9o1m" rowspan="2">PLANT</td>
            <td class="tg-ieig" rowspan="2">PARAMETER</td>
            <td class="tg-9o1m" rowspan="2">PERFORM</td>
            <td class="tg-9o1m" rowspan="2">SATUAN</td>
            <td class="tg-9o1m" colspan="3">OPERASI ( minimal 20 menit )</td>
        </tr>
        <tr>
            <td class="tg-9o1m" colspan="2">sebelum start</td>
            <td class="tg-9o1m">sesudah start</td>
        </tr>
        <tr>
            <td class="tg-9o1m" rowspan="3">2</td>
            <td class="tg-9o1m" rowspan="3">FIRE FIGHTING<br> MOTOR DRIVEN<br></td>
            <td class="tg-ieig" colspan="3">waktu pencatatan</td>
            <td class="tg-9o1m" colspan="2">{{$seawater->md_waktu_pencatatan_sebelum_start}}</td>
            <td class="tg-9o1m">{{$seawater->md_waktu_pencatatan_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-ieig">Discharge Press</td>
            <td class="tg-9o1m">175</td>
            <td class="tg-9o1m">Psi</td>
            <td class="tg-9o1m" colspan="2">{{$seawater->md_discharge_press_sebelum_start}}</td>
            <td class="tg-9o1m">{{$seawater->md_discharge_press_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-ieig">Fuel level ( L / N / F )</td>
            <td class="tg-9o1m">N</td>
            <td class="tg-9o1m">-</td>
            <td class="tg-9o1m" colspan="2">{{$seawater->md_full_level_sebelum_start}}</td>
            <td class="tg-9o1m">{{$seawater->md_full_level_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-9o1m"  colspan="8" style="background-color: darkgray"></td>
           
        </tr>
        <tr>
            <td class="tg-ieig" rowspan="15">3</td>
            <td class="tg-9o1m" rowspan="15">FIRE FIGHTING <br>DIESEL ENGINE</td>
            <td class="tg-73a0" colspan="3">Waktu Pencatatan</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_waktu_pencatatan_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_waktu_pencatatan_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Engine Operating Hours</td>
            <td class="tg-9o1m">-</td>
            <td class="tg-9o1m">Hours</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_engine_operating_hours_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_engine_operating_hours_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Battery I / II Voltage</td>
            <td class="tg-9o1m">26</td>
            <td class="tg-9o1m">V</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_battery_voltage_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_battery_voltage_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Battery I / II Voltage</td>
            <td class="tg-9o1m">4</td>
            <td class="tg-9o1m">A</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_battery_voltage_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_battery_voltage_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Battery Level ( L / N / H )</td>
            <td class="tg-9o1m">N</td>
            <td class="tg-9o1m">-</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_battery_level_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_battery_level_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Fuel level (L / N / F)</td>
            <td class="tg-9o1m">N</td>
            <td class="tg-9o1m">-</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_fuel_level_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_fuel_level_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Crankcase Oil Level ( L / N )</td>
            <td class="tg-9o1m">N</td>
            <td class="tg-9o1m">-</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_crankcase_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_crankcase_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-ieig">Engine&nbsp;&nbsp;&nbsp;coolant Tank (L/N)</td>
            <td class="tg-9o1m">N</td>
            <td class="tg-9o1m">-</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_engine_coolant_tank_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_engine_coolant_tank_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-ieig">Cooling&nbsp;&nbsp;&nbsp;water inlet valve</td>
            <td class="tg-9o1m">Open</td>
            <td class="tg-9o1m">-</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_cooling_water_inlet_valve_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_cooling_water_inlet_valve_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-ieig">Oil&nbsp;&nbsp;&nbsp;pressure</td>
            <td class="tg-9o1m">55</td>
            <td class="tg-9o1m">Psi</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_oil_pressure_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_oil_pressure_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-ieig">Cooling water pressure after <br>regulator </td>
            <td class="tg-9o1m">4</td>
            <td class="tg-9o1m">barg</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_cooling_water_pressure_after_regulator_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_cooling_water_pressure_after_regulator_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-ieig">Coolant&nbsp;&nbsp;&nbsp;temperature </td>
            <td class="tg-9o1m">175-195</td>
            <td class="tg-9o1m">degF</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_coolant_temperature_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_coolant_temperature_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Speed</td>
            <td class="tg-9o1m">2100</td>
            <td class="tg-9o1m">RPM</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_speed_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_speed_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Suction Press</td>
            <td class="tg-9o1m">-</td>
            <td class="tg-9o1m"></td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_suction_press_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_suction_press_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0">Discharge Press</td>
            <td class="tg-9o1m">175</td>
            <td class="tg-9o1m">Psi</td>
            <td class="tg-73a0" colspan="2">{{$seawater->de_discharge_press_sebelum_start}}</td>
            <td class="tg-73a0">{{$seawater->de_discharge_press_sesudah_start}}</td>
        </tr>
        <tr>
            <td class="tg-73a0" colspan="8" rowspan="8"><span style="font-weight:bold"> Keterangan : </span> L : Low N : Normal H : Hight F : Full <br> <br> Catatan : {{$seawater->catatan}} </td>
        </tr>
        <tr>
        </tr>
                <tr>
        </tr>
                <tr>
        </tr>
                <tr>
        </tr>
                        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        
        <tr>
            <td class="tg-f4iu " colspan="2" style="background-color: darkgray"><b>SHIFT</b></td>
            <td class="tg-f4iu" style="background-color: darkgray"><b>K3</b></td>
            <td class="tg-f4iu" colspan="3" style="background-color: darkgray"><b>OPERATOR</b></td>
            <td class="tg-f4iu" colspan="2" style="background-color: darkgray"><b>SUPERVISOR</b></td>
        </tr>
        <tr>
            <td class="tg-9o1m" colspan="2" rowspan="2">{{$seawater->shift}}</td>
            <td class="tg-f4iu"><img src="{{ public_path('storage/'.$seawater->k3_ttd)}}" alt="" style="width:100px ; height:100px"><br><br><br></td>
            <td class="tg-f4iu" colspan="3"><img src="{{ public_path('storage/'.$seawater->operator_ttd)}}" style="width:100px ; height:100px" alt=""></td>
            <td class="tg-f4iu" colspan="2"><img src="{{ public_path('storage/'.$seawater->supervisor_ttd)}}" style="width:100px ; height:100px" alt=""></td>
        </tr>
        <tr>
            <td class="tg-f4iu">{{$seawater->k3_nama}}</td>
            <td class="tg-f4iu" colspan="3">{{$seawater->operator_nama}}</td>
            <td class="tg-f4iu" colspan="2">{{$seawater->supervisor_nama}}</td>
        </tr>

    </table>
</body>

</html>