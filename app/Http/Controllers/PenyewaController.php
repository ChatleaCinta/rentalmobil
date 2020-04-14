<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Penyewa;
use Auth;

class PenyewaController extends Controller
{
    public function index($id){
        $penyewa=DB::table('penyewa')
        ->where('pnyewa.id',$id)
        ->get();
        return response()->json($penyewa); 
}
    public function store(Request $req){
    if(Auth::user()->level=="admin"){
    $validator = Validator::make($req->all(),
    [
        'nama' => 'required',
        'alamat' => 'required',
        'telp' => 'required',
        'no_ktp' => 'required',
        'foto' => 'required'
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors()->toJson(),400);
    }

    $simpan = Penyewa::create([
        'nama' => $req->nama,
        'alamat' => $req->alamat,
        'telp' => $req->telp,
        'no_ktp' => $req->no_ktp,
        'foto' => $req->foto
    ]);
    $status = 1;
    $message = "Data penyewa berhasil ditambahkan";
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
        'nama' => 'required',
        'alamat' => 'required',
        'telp' => 'required',
        'no_ktp' => 'required',
        'foto' => 'required'
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors()->toJson(),400);
    }
    $ubah=Penyewa::where('id',$id)->update([
        'nama' => $req->nama,
        'alamat' => $req->alamat,
        'telp' => $req->telp,
        'no_ktp' => $req->no_ktp,
        'foto' => $req->foto
    ]);
    $status = 1;
    $message = "Data penyewa berhasil diubah";
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
    $data = Penyewa::get();
    $count = $data->count();
    $penyewa = array();
    foreach ($data as $d){

        $penyewa[] = array(
            'id' => $d->id,
            'nama' => $d->nama,
            'alamat' => $d->almaat,
            'telp' => $d->telp,
            'no_ktp' => $d->no_ktp,
            'foto' => $d->foto
        );
    }
    return Response()->json(compact('penyewa','count'));
}
public function destroy($id)
{
    if(Auth::user()->level=="admin"){
    $hapus=Penyewa::where('id',$id)->delete();
    $status = 1;
    $message = "Data penyewa berhasil dihapus";
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
