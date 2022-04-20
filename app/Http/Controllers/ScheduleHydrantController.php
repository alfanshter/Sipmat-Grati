<?php

namespace App\Http\Controllers;

use App\Models\ScheduleHydrant;
use App\Http\Requests\StoreScheduleHydrantRequest;
use App\Http\Requests\UpdateScheduleHydrantRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ScheduleHydrantController extends Controller
{

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_hydrant' => ['required'],
            'tw' => ['required'],
            'tahun' => ['required'],
            'tanggal_cek' => ['required']
                ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $data = $request->all();
            $post = ScheduleHydrant::create($data);
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
        $data = DB::table('schedule_hydrants')
            ->select(['schedule_hydrants.*','hydrants.lokasi'])
            ->join('hydrants','hydrants.kode','=','schedule_hydrants.kode_hydrant')
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
         $data = ScheduleHydrant::where('tw',$request->input('tw'))
             ->where('tahun',$request->input('tahun'))
             ->with('hydrant')
             ->orderBy('tanggal_cek','desc')
             ->get();
 
             $response = [
                 'message' => 'Post hydrant berhasil',
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
 
         $edit = DB::table('schedule_hydrants')->where('id',$request->id)->update($data);
         $response = [
             'message' => 'Post apar berhasil',
             'sukses' => 1,
             'data' =>null
         ];
 
         return response()->json($response, Response::HTTP_CREATED);
         
         
         
     }

     public function hapus_schedule_hydrant(Request  $request)
     {
        $hapus = ScheduleHydrant::where('id',$request->id)->delete();
        $response = [
            'message' => 'Hapus hydrant berhasil',
            'sukses' => 1,
            'data' =>null
        ];
 
        return response()->json($response, Response::HTTP_CREATED);
     }
 
           //tambahan
    public function getschedule_pelaksana_hydrant()
    {
            $data = ScheduleHydrant::where('is_status',0)
                                ->orWhere('is_status',1)
                                ->orWhere('is_status',3)
                                ->with('hydrant')
                                ->orderBy('tanggal_cek','desc')
                                ->get();
                    
                $response = [
                    'message' => 'Post apar berhasil',
                    'data' =>$data
                ];
    
                return response()->json($response, Response::HTTP_CREATED);            
    }

         //admin acc schedule
         public function acc_hydrant(Request $request)
         {
             $validator = Validator::make($request->all(),[
                 'id' => ['required']
                     ]);
     
             
             if ($validator->fails()) {
                 return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
             }
     
             $update = Schedulehydrant::where('id', $request->id)
                                 ->update(['is_status'=>2]);
             
             $response = [
                 'message' => 'Update hydrant berhasil',
                 'sukses' => 1,
                 'data' =>null
             ];
     
             return response()->json($response, Response::HTTP_CREATED);
     
         }
     
          //admin return schedule
          public function return_hydrant(Request $request)
          {
              $validator = Validator::make($request->all(),[
                  'id' => ['required']
                      ]);
      
              
              if ($validator->fails()) {
                  return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
              }
      
              $update = Schedulehydrant::where('id', $request->id)
                                  ->update(['is_status'=>3]);
              
              $response = [
                  'message' => 'Update apar berhasil',
                  'sukses' => 1,
                  'data' =>null
              ];
      
              return response()->json($response, Response::HTTP_CREATED);
      
          }
     
    
          public function hydrant_pdf(Request $request)
          {
              $ekstensi = $request->file('foto')->getClientOriginalExtension();
              $foto = $request->file('foto')->storeAs('public/ttd-hydrant','hydrant-ttd.png');
              $data = Schedulehydrant::where('tw',$request->tw)
                                      ->where('tahun',$request->tahun)
                                      ->where('is_status',2)
                                      ->with('hydrant')
                                      ->get();
                                      
              $jabatan = $request->jabatan;
              $nama = $request->nama;
      
              $pdf = Pdf::loadView('hydrant.hydrant_pdf',
              ['data'=>$data,
              'jabatan'=>$jabatan,
              'nama'=>$nama])->setPaper('a4', 'landscape');
              $content = $pdf->download()->getOriginalContent();
              Storage::put('public/csv/hydrant/hydrant.pdf',$content) ;
              $response = [
                  'message' => 'sudah hydrant hari ini',
                  'status' => 1,
                  'data' => url('/').'/storage/csv/hydrant/hydrant.pdf' ];    
              return response()->json($response,Response::HTTP_OK);
              
      
              // return $pdf->download('itsolutionstuff.pdf');
          }
    
 
}