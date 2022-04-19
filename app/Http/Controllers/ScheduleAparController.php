<?php

namespace App\Http\Controllers;

use App\Models\ScheduleApar;
use App\Http\Requests\StoreScheduleAparRequest;
use App\Http\Requests\UpdateScheduleAparRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduleAparController extends Controller
{
 //is status 
    // 0 = belum di cek 
    // 1 = sudah di cek 
    // 2 = di approve
    // 3 = di tolak
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_apar' => ['required'],
            'tw' => ['required'],
            'tahun' => ['required'],
            'tanggal_cek' => ['required']
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
    
    public function getschedule(Request $request)
    {
        $data = DB::table('schedule_apars')
            ->select(['schedule_apars.*','apars.lokasi'])
            ->join('apars','apars.kode','=','schedule_apars.kode_apar')
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

    public function gethasil(Request $request)
    {
        $data = DB::table('schedule_apars')
            ->select(['schedule_apars.*','apars.lokasi','apars.tgl_kadaluarsa','apars.jenis'])
            ->join('apars','apars.kode','=','schedule_apars.kode_apar')
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

        $edit = DB::table('schedule_apars')->where('id',$request->id)->update($data);
        $response = [
            'message' => 'Post apar berhasil',
            'sukses' => 1,
            'data' =>null
        ];

        return response()->json($response, Response::HTTP_CREATED);
        
        
        
    }

    //tambahan
    public function getschedule_pelaksana(Request $request)
    {
        $data = DB::table('schedule_apars')
            ->select(['schedule_apars.*','apars.lokasi'])
            ->join('apars','apars.kode','=','schedule_apars.kode_apar')
            ->where('schedule_apars.is_status',0)
            ->orWhere('schedule_apars.is_status',1)
            ->orWhere('schedule_apars.is_status',3)
            ->orderBy('tanggal_cek','desc')
            ->get();

            $response = [
                'message' => 'Post apar berhasil',
                'data' =>$data
            ];

            return response()->json($response, Response::HTTP_CREATED);            
    }
    //admin acc schedule
    public function acc_apar(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => ['required']
                ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $update = ScheduleApar::where('id', $request->id)
                            ->update(['is_status'=>2]);
        
        $response = [
            'message' => 'Update apar berhasil',
            'sukses' => 1,
            'data' =>null
        ];

        return response()->json($response, Response::HTTP_CREATED);

    }

     //admin return schedule
     public function return_apar(Request $request)
     {
         $validator = Validator::make($request->all(),[
             'id' => ['required']
                 ]);
 
         
         if ($validator->fails()) {
             return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
         }
 
         $update = ScheduleApar::where('id', $request->id)
                             ->update(['is_status'=>3]);
         
         $response = [
             'message' => 'Update apar berhasil',
             'sukses' => 1,
             'data' =>null
         ];
 
         return response()->json($response, Response::HTTP_CREATED);
 
     }

     public function hapus_schedule_apar(Request  $request)
     {
        $hapus = ScheduleApar::where('id',$request->id)->delete();
        $response = [
            'message' => 'Hapus apar berhasil',
            'sukses' => 1,
            'data' =>null
        ];

        return response()->json($response, Response::HTTP_CREATED);
     }

    



}