<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Exception;
use App\Helpers\formatAPI;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //menampilkan semua data pada model siswa
      $data = Penduduk::all();

      //check data is valid? return data : failed
      if($data){
         return formatAPI::createAPI(200, 'Success', $data);
      }
      else{
         return formatAPI::createAPI(400, 'Failed');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            //untuk create data ke database
            $penduduk = Penduduk::create($request->all());

            //get data siswa where id_siswa = id_siswa
            $data = Penduduk::where('nik','=',$penduduk->nik)->get();

            //check data is valid? return data : failed
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
             }
             else{
                return formatAPI::createAPI(400,'Failed');
             }
    }catch(Exception $error){
    
        return formatAPI::createAPI(400,'Failed',$error);
    }
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penduduk $Penduduk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = Penduduk::where('id', '=', $id)->first();
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
             }
             else{
                return formatAPI::createAPI(400,'Failed');
             }
        }
    catch(Expection $error){
        return formatAPI::createAPI(400,'Failed',$error);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */

     public function update (Request $request, $id)
    {
        try{
            $penduduk = Penduduk::findorfail($id);
            $penduduk->update($request->all());

            $data = Penduduk::where('nik', '=',$penduduk->nik)->get();
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
             }
             else{
                return formatAPI::createAPI(400,'Failed');
             }
        }catch(exception $error){
            return formatAPI::createAPI(400,'Failed'. $error);
        }
    }

    public function destroy($id)
    {
        try{
            $penduduk = Penduduk::findorfail($id);

            $data = $penduduk->delete();
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
             }
             else{
                return formatAPI::createAPI(400,'Failed');
             }
        }catch(exception $error){
            return formatAPI::createAPI(400,'Failed'. $error);
        }
    }
}
