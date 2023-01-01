<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $file = Berkas::where('id_user', Auth::user()->id)->get();
        return view('home.index', ['file' => $file]);
    }

    public function prosesUpload(Request $request){
        $this->validate($request, [
			'file' => 'required|file',
		]);
        
		$file = $request->file('file');

        $nama_file = time()."_".$file->getClientOriginalName();
        $ukuran_file = $file->getSize();
 
        Berkas::create([
            'id_user' => Auth::user()->id,
            'nama_file' => $nama_file,
            'nama_file_asli' => $file->getClientOriginalName(),
            'tipe_file' => $file->getMimeType(),
            'ukuran_file' => $ukuran_file
        ]);
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);
 
        Session::flash('status', 'File berhasil ditambahkan');
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
            Session::flash('status', 'File berhasil dihapus');
            return redirect()->back();
        }else{
            dd('File tidak ada.');
        }
    }
}
