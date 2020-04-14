<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\JenisMobil;
use Auth;

class JenisMobilController extends Controller
{
    public function index($id){
            $jenis_mobil=DB::table('jenis_mobil')
            ->where('jenis_mobil.id',$id)
            ->get();
            return response()->json($jenis_cuci); 
    }
    public function store(Request $req){
        if(Auth::user()->level=="admin"){
        $validator = Validator::make($req->all(),
        [
            'nama_jenis' => 'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson(),400);
        }

        $simpan = JenisMobil::create([
            'nama_jenis' => $req->nama_jenis
        ]);
        $status = 1;
        $message = "Data jenis mobil berhasil ditambahkan";
        if($simpan){
            return Response()->json(compact('status', 'message'));
        }else {
            return Response()->json(['status'=> 0]);
        }
    }
    else {
        return response()->json(['status'=>'anda bukan admin']);
    }
}
    public function update($id, Request $req)
    {
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'nama_jenis' => 'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson(),400);
        }
        $ubah=JenisMobil::where('id',$id)->update([
            'nama_jenis' => $req->nama_jenis
        ]);
        $status = 1;
        $message = "Data jenis mobil berhasil diubah";
        if($ubah){
            return Response()->json(compact('status', 'message'));
        }else {
            return Response()->json(['status'=> 0]);
        }
    }
    else {
        return response()->json(['status'=>'anda bukan admin']);
    }
}
    public function tampil(){
        $data = JenisMobil::get();
        $count = $data->count();
        $jenis = array();
        foreach ($data as $d){

            $jenis[] = array(
                'id' => $d->id,
                'nama_jenis' => $d->nama_jenis
            );
        }
        return Response()->json(compact('jenis','count'));
    }
    public function destroy($id)
    {
        if(Auth::user()->level=="admin"){
        $hapus=JenisMobil::where('id',$id)->delete();
        $status = 1;
        $message = "Data jenis mobil berhasil dihapus";
        if($hapus){
            return Response()->json(compact('status', 'message'));
        }else {
            return Response()->json(['status'=> 0]);
        }
    }
    else {
        return response()->json(['status'=>'anda bukan admin']);
    }
    }

}

    
