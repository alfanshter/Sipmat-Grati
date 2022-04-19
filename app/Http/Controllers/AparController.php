<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Http\Requests\StoreAparRequest;
use App\Http\Requests\UpdateAparRequest;
use App\Models\ScheduleApar;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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

    public function updateapar(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'kode' => ['required'],
            'id' => ['required'],
            'jenis' => ['required'],
            'lokasi' => ['required'],
            'tgl_pengisian' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();
        $time = strtotime($request->tgl_pengisian);
        $tgl_sekarang = date('Y-m-d',$time);
        $tgl_kadaluarsa= date('Y-m-d', strtotime($tgl_sekarang. '+3 years'));

        $data['tgl_kadaluarsa'] = $tgl_kadaluarsa;

        $edit = DB::table('apars')->where('id',$request->id)->update($data);
        $response = [
            'message' => 'Post apar berhasil',
            'sukses' => 1,
            'data' =>null
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }
    public function index()
    {
        $data= Apar::all();
        $response = [
            'message' => 'Post apar berhasil',
            'data' =>$data
        ];
        return response()->json($response, Response::HTTP_OK);

    }

    public function deleteapar(Request $request)
    {
        DB::table('apars')->where('id',$request->id)->delete();
        $response = [
            'message' => 'celete apar berhasil',
            'sukses' => 1
        ];
        return response()->json($response, Response::HTTP_OK);

    }

    //tambahan
    //cek apar
    public function cekapar(Request $request)
    {
        $data= Apar::where('kode',$request->input('kode'))->first();
        $response = [
            'message' => 'Post apar berhasil',
            'data' =>$data
        ];
        return response()->json($response, Response::HTTP_OK);

    }
    //Apar kadaluarsa
    public function apar_kadaluarsa(Request $request)
    {
           try {
            date_default_timezone_set('Asia/Jakarta');
            $hari = date('Y-m-d', time());
            $apar = Apar::where('tgl_kadaluarsa','<=',$hari)
            ->get();
            $response = [
                    'message' => 'member sudah habis',
                    'data' => $apar ];    
            return response()->json($response,Response::HTTP_OK);
        } catch (QueryException $th) {
            $response = [
                    'message' => 'sudah apar hari ini',
                    'data' => $th->errorInfo ];    
            return response()->json($response,Response::HTTP_OK);
        }
    }

    public function apar_pdf(Request $request)
    {
        $ekstensi = $request->file('foto')->getClientOriginalExtension();
        $foto = $request->file('foto')->storeAs('public/ttd-apar','apar-ttd.png');
        $data = ScheduleApar::where('tw',$request->tw)
                                ->where('tahun',$request->tahun)
                                ->where('is_status',2)
                                ->with('apar')
                                ->get();
                                
        $jabatan = $request->jabatan;
        $nama = $request->nama;

        $pdf = Pdf::loadView('apar.apar_pdf',
        ['data'=>$data,
        'jabatan'=>$jabatan,
        'nama'=>$nama])->setPaper('a4', 'landscape');
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/csv/apar/apar.pdf',$content) ;
        $response = [
            'message' => 'sudah apar hari ini',
            'status' => 1,
            'data' => url('/').'/storage/csv/apar/apar.pdf' ];    
        return response()->json($response,Response::HTTP_OK);
        

        // return $pdf->download('itsolutionstuff.pdf');
    }
}