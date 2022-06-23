<?php

namespace App\Http\Controllers;

use App\Models\FFBlok1;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class FFblok1Controller extends Controller
{
    public function insert_ffblok(Request $request)
    {

        try {
            $data = $request->all();
            $post = FFBlok1::create($data);
            $response = [
                'message' => 'Post ffblok berhasil',
                'sukses' => 1,
                'data' => null
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            $response = [
                'message' => 'Post ffblok gagal',
                'status' => 0,
                'data' => $e->errorInfo
            ];

            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function get_ffblok(Request $request)
    {

        $data = FFBlok1::where('tw', $request->input('tw'))
            ->where('tahun', $request->input('tahun'))
            ->orderBy('tanggal_cek', 'desc')
            ->get();

        $response = [
            'message' => 'Get ffblok berhasil',
            'data' => $data
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function hapus_ffblok(Request $request)
    {
        $hapus = FFBlok1::where('id', $request->id)->delete();
        $response = [
            'message' => 'Post ffblok berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function ffblok_pelaksana()
    {
        $data = FFBlok1::where('is_status', 0)
            ->orWhere('is_status', 1)
            ->orWhere('is_status', 3)
            ->orderBy('tanggal_cek', 'desc')
            ->get();

        $response = [
            'message' => 'Post ffblok berhasil',
            'data' => $data
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function update_ffblok(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        if ($request->file('k3_ttd')) {
            $data['k3_ttd'] = $request->file('k3_ttd')->store('foto-ffblok', 'public');
        }

        if ($request->file('operator_ttd')) {
            $data['operator_ttd'] = $request->file('operator_ttd')->store('foto-ffblok', 'public');
        }

        if ($request->file('supervisor_ttd')) {
            $data['supervisor_ttd'] = $request->file('supervisor_ttd')->store('foto-ffblok', 'public');
        }

        $data['tanggal_cek'] = date(now());

        $edit = FFBlok1::where('id', $request->id)->update($data);
        $response = [
            'message' => 'Post ffblok berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    //admin return schedule
    public function return_ffblok(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $update = FFBlok1::where('id', $request->id)
            ->update(['is_status' => 3]);

        $response = [
            'message' => 'Update apar berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    //admin acc schedule
    public function acc_ffblok(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $update = FFBlok1::where('id', $request->id)
            ->update(['is_status' => 2]);

        $response = [
            'message' => 'Update ffblok berhasil',
            'sukses' => 1,
            'data' => null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }


    public function ffblok_pdf(Request $request)
    {
        $data = FFBlok1::where('id', $request->id)
            ->first();


        $pdf = Pdf::loadView(
            'ffblok.ffblok_pdf',
            [
                'ffblok' => $data
            ]
        )->setPaper('a4', 'potrait');


        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/csv/ffblok/ffblok.pdf', $content);
        $response = [
            'message' => 'sudah ffblok hari ini',
            'status' => 1,
            'data' => url('/') . '/storage/csv/ffblok/ffblok.pdf'
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
