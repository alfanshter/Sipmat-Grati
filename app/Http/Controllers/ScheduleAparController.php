<?php

namespace App\Http\Controllers;

use App\Models\ScheduleApar;
use App\Http\Requests\StoreScheduleAparRequest;
use App\Http\Requests\UpdateScheduleAparRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduleAparController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_apar' => ['required'],
            'tw' => ['required'],
            'tahun' => ['required']
                ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = $request->all();
            $post = ScheduleApar::create($data);
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
