@extends('templates.app')

@section('title', 'Cloud Storage')

@section('content')
<div class="container">
  <div class="row">
    <div class="col mt-5">
      <h1>Berkas Anda</h1>
    </div>
  </div>
  <div class="row">
    <div class="col mt-5">
        @if(count($errors) > 0)
          <div class="alert alert-danger mb-5">
            @foreach ($errors->all() as $error)
            {{ $error }}<br/>
            @endforeach
          </div>
				@endif


      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Upload File
      </button>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="{{ url('/upload') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="file" class="form-label">Pilih File</label>
                  <input class="form-control" type="file" id="file" name="file">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <input type="submit" value="Simpan" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col mt-5">
      <table class="table">
        <thead>
          <tr class="table-primary">
            <th scope="col" width="80%">Nama File</th>
            <th scope="col" width="20%">Opsi</th>
          </tr>
        </thead>
        <tbody>
          @if(count($file) > 0)
            @foreach($file as $f)
              <tr>
                <td>{{$f->nama_file_asli}}</td>
                <td>
                  <form action="{{ url('/download') }}" method="post">
                    @csrf
                    <input type="hidden" name="file" value="{{$f->nama_file}}">
                    <input type="hidden" name="fileasli" value="{{$f->nama_file_asli}}">
                    <input type="hidden" name="tipe" value="{{$f->tipe_file}}">
                    <input type="submit" value="Download" class="btn btn-primary mb-1">
                  </form>
                  <form action="{{ url('/hapus') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$f->id}}">
                    <input type="hidden" name="file" value="{{$f->nama_file}}">
                    <input type="submit" value="Hapus" class="btn btn-danger">
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="2">File kosong</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
  