<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File as Berkas;
use Illuminate\Support\Facades\File as ToolFile;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = Berkas::get();
        return view('home.index', ['file' => $file]);
    }

    public function prosesUpload(Request $request){
        $this->validate($request, [
			'file' => 'required|file',
		]);
 
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');

        $nama_file = time()."_".$file->getClientOriginalName();
        $ukuran_file = $file->getSize();
 
        Berkas::create([
            'nama_file' => $nama_file,
            'nama_file_asli' => $file->getClientOriginalName(),
            'tipe_file' => $file->getMimeType(),
            'ukuran_file' => $ukuran_file
        ]);
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);
 
 
		return redirect()->back();
    }

    public function download(Request $request){
        $file = public_path(). "/data_file/" . $request->file;

        $originalFile = $request->fileasli;

        $headers = ['Content-Type: ' . $request->tipe];

        return response()->download($file, $originalFile, $headers);
    }

    public function hapus(Request $request)
    {
        $berkas = $request->file;
        if(ToolFile::exists(public_path('data_file/'. $berkas))){
            Berkas::where('id', $request->id)->delete();
            ToolFile::delete(public_path('data_file/' . $berkas));
            return redirect()->back();
        }else{
            dd('File tidak ada.');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
