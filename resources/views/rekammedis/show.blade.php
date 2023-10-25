@extends('rekammedis.base')

@section('title', 'Detail Rekam Medis {{ $rekam_medis->id }}')

@section('content')
    <div class="container p-5">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3>Rekam Medis {{ $rekam_medis->id }}</h3>
            </div>

            <div class="col-md-12 mb-4">
                <h4>Nama Pasien</h4>
                <h5>{{ $rekam_medis->pasien->name }}</h5>
            </div>

            <div class="col-md-12 mb-4">
                <h4>Nama Dokter</h4>
                <h5>{{ $rekam_medis->dokter->name }}</h5>
            </div>

            <div class="col-md-12 mb-4">
                <h4>Kondisi Kesehatan</h4>

                <p>
                    {{ $rekam_medis->kondisi_kesehatan }}
                </p>
            </div>

            <div class="col-md-12 mb-4">
                <h4>Suhu Tubuh</h4>
                <h5>{{ $rekam_medis->suhu_tubuh }}</h5>
            </div>
            
            <form action="/rekamMedis/{{ $rekam_medis->id }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="_method" value="DELETE">

                <a href="/storage/{{ $rekam_medis->url_resep }}" class="btn btn-primary">Lihat Resep</a>
                <a href="/rekamMedis/{{ $rekam_medis->id }}/edit" class="btn btn-primary">Edit</a>
                <input type="submit" class="btn btn-danger" value="Delete">
            </form>
        </div>
    </div>
@endsection