<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Mobil;
use Auth;

class MobilController extends Controller
{
    public function index($id){
            $mobil=DB::table('mobil')
            ->where('mobil.id',$id)
            ->get();
            return response()->json($mobil); 
    }
    public function store(Request $req){
        if(Auth::user()->level=="admin"){
        $validator = Validator::make($req->all(),
        [
            'merk' => 'required',
            'plat_no' => 'required',
            'foto' => 'required',
            'ket' => 'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson(),400);
        }

        $simpan = Mobil::create([
            'merk' => $req->merk,
            'plat_no' => $req->plat_no,
            'foto' => $req->foto,
            'ket' => $req->ket
        ]);
        $status = 1;
        $message = "Data mobil berhasil ditambahkan";
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
            'merk' => 'required',
            'plat_no' => 'required',
            'foto' => 'required',
            'ket' => 'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson(),400);
        }
        $ubah=Mobil::where('id',$id)->update([
            'merk' => $req->merk,
            'plat_no' => $req->plat_no,
            'foto' => $req->foto,
            'ket' => $req->ket
        ]);
        $status = 1;
        $message = "Data mobil berhasil diubah";
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
        $data = Mobil::get();
        $count = $data->count();
        $mobil = array();
        foreach ($data as $d){

            $mobil[] = array(
                'id' => $d->id,
                'merk' => $d->merk,
                'plat_no' => $d->plat_no,
                'foto' => $d->foto,
                'ket' => $d->ket
            );
        }
        return Response()->json(compact('mobil','count'));
    }
    public function destroy($id)
    {
        if(Auth::user()->level=="admin"){
        $hapus=Mobil::where('id',$id)->delete();
        $status = 1;
        $message = "Data mobil berhasil dihapus";
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

    
