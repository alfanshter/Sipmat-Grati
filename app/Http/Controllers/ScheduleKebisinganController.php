<?php

namespace App\Http\Controllers;

use App\Models\ScheduleKebisingan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduleKebisinganController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_kebisingan' => ['required'],
            'tw' => ['required'],
            'tahun' => ['required'],
            'tanggal_cek' => ['required']
                ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = $request->all();
            $post = ScheduleKebisingan::create($data);
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
        $data = DB::table('schedule_kebisingans')
            ->select(['schedule_kebisingans.*','kebisingans.lokasi'])
            ->join('kebisingans','kebisingans.kode','=','schedule_kebisingans.kode_kebisingan')
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
          $data = DB::table('schedule_kebisingans')
              ->select(['schedule_kebisingans.*','kebisingans.lokasi'])
              ->join('kebisingans','kebisingans.kode','=','schedule_kebisingans.kode_kebisingan')
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
  
          $edit = DB::table('schedule_kebisingans')->where('id',$request->id)->update($data);
          $response = [
              'message' => 'Post apar berhasil',
              'sukses' => 1,
              'data' =>null
          ];
  
          return response()->json($response, Response::HTTP_CREATED);
          
          
          
      }

}
