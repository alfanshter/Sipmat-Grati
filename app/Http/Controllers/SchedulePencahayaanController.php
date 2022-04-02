<?php

namespace App\Http\Controllers;

use App\Models\SchedulePencahayaan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
class SchedulePencahayaanController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_pencahayaan' => ['required'],
            'tw' => ['required'],
            'tahun' => ['required'],
            'tanggal_cek' => ['required']
                ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = $request->all();
            $post = SchedulePencahayaan::create($data);
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

    public function getschedule(Request $request)
    {
        $data = DB::table('schedule_pencahayaans')
            ->select(['schedule_pencahayaans.*','pencahayaans.lokasi'])
            ->join('pencahayaans','pencahayaans.kode','=','schedule_pencahayaans.kode_pencahayaan')
            ->where('tw',$request->input('tw'))
            ->where('tahun',$request->input('tahun'))
            ->orderBy('tanggal_cek','desc')
            ->get();

            $response = [
                'message' => 'Post apar berhasil',
                'data' =>$data
            ];

            return response()->json($response, Response::HTTP_CREATED);
            
    }

      // jika user sudah mensetujui
      public function gethasil(Request $request)
      {
          $data = DB::table('schedule_pencahayaans')
              ->select(['schedule_pencahayaans.*','pencahayaans.lokasi'])
              ->join('pencahayaans','pencahayaans.kode','=','schedule_pencahayaans.kode_pencahayaan')
              ->where('tw',$request->input('tw'))
              ->where('tahun',$request->input('tahun'))
              ->orderBy('tanggal_cek','desc')
              ->get();
  
              $response = [
                  'message' => 'Post apar berhasil',
                  'data' =>$data
              ];
  
              return response()->json($response, Response::HTTP_CREATED);
              
      }

      public function updateschedule(Request $request)
      {
          $validator = Validator::make($request->all(),[
              'id' => ['required'] ]);
  
          
          if ($validator->fails()) {
              return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
          }
  
          $data = $request->all();
  
          $edit = DB::table('schedule_pencahayaans')->where('id',$request->id)->update($data);
          $response = [
              'message' => 'Post apar berhasil',
              'sukses' => 1,
              'data' =>null
          ];
  
          return response()->json($response, Response::HTTP_CREATED);
          
          
          
      }
}
