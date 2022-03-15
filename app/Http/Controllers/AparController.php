<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Http\Requests\StoreAparRequest;
use App\Http\Requests\UpdateAparRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AparController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode' => ['required'],
            'jenis' => ['required'],
            'lokasi' => ['required'],
            'tgl_pengisian' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = $request->all();
            $time = strtotime($request->tgl_pengisian);
            $tgl_sekarang = date('Y-m-d',$time);
            $tgl_kadaluarsa= date('Y-m-d', strtotime($tgl_sekarang. '+3 years'));

            $data['tgl_kadaluarsa'] = $tgl_kadaluarsa;
            $post = Apar::create($data);
            $response = [
                'message' => 'Post apar berhasil',
                'sukses' => 1,
                'data' =>null
            ];

            return response()->json($response, Response::HTTP_CREATED);

        } catch (QueryException $e) {
            $response = [
                'message' => 'Post apar gagal',
                'status' => 0,
                'data'=> $e->errorInfo
            ];

            return response()->json($response, Response::HTTP_OK);
        }


    }
}
