<?php

namespace App\Http\Controllers;

use App\Models\pctKuis;
use App\Models\pctKuisHasil;
use App\Models\pctSekolah;
use App\Models\pctProdi;
use App\Models\Soal;
use App\Models\Kui;
use App\Models\CatUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
class SoalController extends Controller
{
    //    
    function pct_kuis()  {
        $data  = pctKuis::with("soal.opsi")->first();
        $sekolah  = pctSekolah::get();
        $prodi  = pctProdi::get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'sekolah' => $sekolah,
            'prodi' => $prodi,
        ], 200);
    }

    function pct_kuis_submit(Request $request)  {

        $jawaban  = json_decode($request->jawaban,true);
        // return $jawaban;
        $data  = pctKuis::with("soal.opsi")->first();

        $benar = 0;
        $total = $data->soal()->count() ;
        // return $total ;
        
        foreach ($data->soal()->get() as $key => $value) {
            if ($value->kunci==$jawaban[$value->id]){
                $benar++;
            }
        }
        
        $nilai  = round($benar/ $total*100);

        $save = New pctKuisHasil();
        $save->nama  = $request->nama;
        $save->wa  = $request->wa;
        $save->sosmed  = $request->sosmed;
        $save->sekolah  = $request->sekolah;
        $save->prodi  = $request->prodi;
        $save->jawaban  = json_encode($jawaban);
        $save->nilai  = $nilai;
        $save->save() ;


        return response()->json([
            'status' => 'success',
            'data' => $save
        ], 200);
    }
    
    function kuis()  {
        $data  = Kui::get();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    function kuis_detail(Request $request ,$id)  {
        $data  = Kui::where("id",$id)->first();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }


    function kuis_add(Request $request) {

        $v = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);

        }

        $save = New Kui() ;
        $save->name = $request->name;
        $save->status = "1";
        $save->save();

        return response()->json([
            'status' => 'success',
            'data' => $save
        ], 200);

    }

    function kuis_edit(Request $request) {

        $v = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);

        }

        $save =  Kui::where("id",$request->id)->first() ;
        $save->name = $request->name;
        $save->save();

        return response()->json([
            'status' => 'success',
            'data' => $save
        ], 200);

    }

    function kuis_delete(Request $request) {
        $save =  Kui::where("id",$request->id)->delete() ;
        return response()->json([
            'status' => 'success',
            'data' => "Berhasil"
        ], 200);
    }

    function kategori()  {
        $data  = CatUser::where("user_id",Auth::user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    function kategori_add(Request $request) {

        $v = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);

        }

        $save = New CatUser() ;
        $save->name = $request->name;
        $save->user_id = Auth::user()->id;
        $save->status = 1;
        $save->save();

        return response()->json([
            'status' => 'success',
            'data' => $save
        ], 200);

    }


    function kategori_edit(Request $request) {

        $v = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);

        }

        $save =  CatUser::where("user_id",Auth::user()->id)->where("id",$request->id)->first();;
        $save->name = $request->name;
        $save->save();

        return response()->json([
            'status' => 'success',
            'data' => $save
        ], 200);

    }


}

