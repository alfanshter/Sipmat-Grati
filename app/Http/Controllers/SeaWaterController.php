<?php

namespace App\Http\Controllers;

use App\Models\SeaWater;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SeaWaterController extends Controller
{
    public function insert_seawater(Request $request)
    {

        try {
            $data = $request->all();
            $post = SeaWater::create($data);
            $response = [
                'message' => 'Post sea water berhasil',
                'sukses' => 1,
                'data' => null
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            $response = [
                'message' => 'Post sea water gagal',
                'status' => 0,
                'data' => $e->errorInfo
            ];

            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function get_seawater(Request $request)
    {

        $data = SeaWater::where('tw', $request->input('tw'))
            ->where('tahun', $request->input('tahun'))
            ->orderBy('tanggal_cek', 'desc')
            ->get();

        $response = [
            'message' => 'Get sea water berhasil',
            'data' => $data
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function hapus_seawater(Request $request)
    {
        $hapus = SeaWater::where('id', $request->id)->delete();
        $response = [
            'message' => 'Post sea water berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function seawater_pelaksana()
    {
        $data = SeaWater::where('is_status', 0)
            ->orWhere('is_status', 1)
            ->orWhere('is_status', 3)
            ->orderBy('tanggal_cek', 'desc')
            ->get();

        $response = [
            'message' => 'Post sea water berhasil',
            'data' => $data
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function update_seawater(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        if ($request->file('k3_ttd')) {
            $data['k3_ttd'] = $request->file('k3_ttd')->store('foto-seawater', 'public');
        }

        if ($request->file('operator_ttd')) {
            $data['operator_ttd'] = $request->file('operator_ttd')->store('foto-seawater', 'public');
        }

        if ($request->file('supervisor_ttd')) {
            $data['supervisor_ttd'] = $request->file('supervisor_ttd')->store('foto-seawater', 'public');
        }

        $data['tanggal_cek'] = date(now());

        $edit = SeaWater::where('id', $request->id)->update($data);
        $response = [
            'message' => 'Post sea water berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    //admin return schedule
    public function return_seawater(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $update = SeaWater::where('id', $request->id)
            ->update(['is_status' => 3]);

        $response = [
            'message' => 'Update apar berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    //admin acc schedule
    public function acc_seawater(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $update = SeaWater::where('id', $request->id)
            ->update(['is_status' => 2]);

        $response = [
            'message' => 'Update seawater berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }


    public function seawater_pdf(Request $request)
    {
        $data = SeaWater::where('id', $request->id)
            ->first();


        $pdf = Pdf::loadView(
            'seawater.seawater_pdf',
            [
                'seawater' => $data
            ]
        )->setPaper('a4', 'potrait');


        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/csv/seawater/seawater.pdf', $content);
        $response = [
            'message' => 'sudah seawater hari ini',
            'status' => 1,
            'data' => url('/') . '/storage/csv/seawater/seawater.pdf'
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
