@extends('rekammedis.base')

@section('title', 'Riwayat Rekam Medis')

@section('content')

@section('heading', 'Riwayat Rekam Medis')

@if (count($rekam_medis) == 0)
    <b>Tidak ada riwayat rekam medis.</b>
    <b>Klik <a href="{{ URL::to('rekamMedis/create') }}">di sini</a> untuk membuat riwayat rekam medis baru.</b>
@else
    <div class="row p-3">
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID Rekam Medis</th>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($rekam_medis as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->pasien->name }}</td>
                <td>{{ $value->dokter->name }}</td>
                <td>
                    <form action="/rekamMedis/{{ $value->id }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        
                        <a href="/rekamMedis/{{ $value->id }}" class="btn btn-primary">Tampilkan</a>
                        <a href="/rekamMedis/{{ $value->id }}/edit" class="btn btn-success">Edit</a>
                        <input type="submit" class="btn btn-danger" value="Hapus">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
        
    </div>
@endif

@endsection