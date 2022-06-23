<?php

namespace App\Http\Controllers;

use App\Models\ScheduleApat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduleApatController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_apat' => ['required'],
            'tw' => ['required'],
            'tahun' => ['required'],
            'tanggal_cek' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = $request->all();
            $post = ScheduleApat::create($data);
            $response = [
                'message' => 'Post apat berhasil',
                'sukses' => 1,
                'data' => null
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            $response = [
                'message' => 'Post apat gagal',
                'status' => 0,
                'data' => $e->errorInfo
            ];

            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function getschedule(Request $request)
    {
        $data = DB::table('schedule_apats')
            ->select(['schedule_apats.*', 'apats.lokasi'])
            ->join('apats', 'apats.kode', '=', 'schedule_apats.kode_apat')
            ->where('tw', $request->input('tw'))
            ->where('tahun', $request->input('tahun'))
            ->orderBy('tanggal_cek', 'desc')
            ->get();

        $response = [
            'message' => 'Post apat berhasil',
            'data' => $data
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    // jika user sudah mensetujui
    public function gethasil(Request $request)
    {
        $data = ScheduleApat::where('tw', $request->input('tw'))
            ->where('tahun', $request->input('tahun'))
            ->with('apat')
            ->orderBy('tanggal_cek', 'desc')
            ->get();

        $response = [
            'message' => 'Post apat berhasil',
            'data' => $data
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function updateschedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tw' => ['required'],
            'tahun' => ['required'],
            'tanggal_cek' => ['required'],
            'id' => ['required'],
            'is_status' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        $edit = DB::table('schedule_apats')->where('id', $request->id)->update($data);
        $response = [
            'message' => 'Post apat berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function hapus_schedule_apat(Request  $request)
    {
        $hapus = ScheduleApat::where('id', $request->id)->delete();
        $response = [
            'message' => 'Hapus apat berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    //tambahan
    public function getschedule_pelaksana_apat()
    {
        $data = ScheduleApat::where('is_status', 0)
            ->orWhere('is_status', 1)
            ->orWhere('is_status', 3)
            ->with('apar')
            ->orderBy('tanggal_cek', 'desc')
            ->get();

        $response = [
            'message' => 'Post apar berhasil',
            'data' => $data
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    //admin acc schedule
    public function acc_apat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $update = ScheduleApat::where('id', $request->id)
            ->update(['is_status' => 2]);

        $response = [
            'message' => 'Update apat berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    //admin return schedule
    public function return_apat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $update = ScheduleApat::where('id', $request->id)
            ->update(['is_status' => 3]);

        $response = [
            'message' => 'Update apar berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }


    public function apat_pdf(Request $request)
    {
        $ekstensi = $request->file('foto')->getClientOriginalExtension();
        $foto = $request->file('foto')->storeAs('public/ttd-apat', 'apat-ttd.png');
        $data = ScheduleApat::where('tw', $request->tw)
            ->where('tahun', $request->tahun)
            ->where('is_status', 2)
            ->with('apat')
            ->get();

        $jabatan = $request->jabatan;
        $nama = $request->nama;

        $pdf = Pdf::loadView(
            'apat.apat_pdf',
            [
                'data' => $data,
                'jabatan' => $jabatan,
                'nama' => $nama
            ]
        )->setPaper('a4', 'landscape');
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/csv/apat/apat.pdf', $content);
        $response = [
            'message' => 'sudah apat hari ini',
            'status' => 1,
            'data' => url('/') . '/storage/csv/apat/apat.pdf'
        ];
        return response()->json($response, Response::HTTP_OK);


        // return $pdf->download('itsolutionstuff.pdf');
    }
}
