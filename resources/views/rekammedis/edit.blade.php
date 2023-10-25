@extends('rekammedis.base')

@section('title', 'Edit Rekam Medis')

@section('content')

@section('heading', 'Edit Rekam Medis')

<form action="/rekamMedis/{{ $rekam_medis->id }}" method="post" enctype="multipart/form-data" class="container p-4">
    {{ csrf_field() }}

    <input type="hidden" name="_method" value="PATCH">

    <div class="mt-2 mb-2">
        <label for="pasien_id" class="form-label">Nama Pasien</label>
        <select name="pasien_id" id="pasien_id" class="form-control">
            <option
                value=""
                disabled
                
                @if (old('pasien_id') == "")
                    selected
                @endif
            >
                Pilih satu...
            </option>
            
            @foreach ($pasien as $key => $value)
                <option
                    value="{{ $value->id }}"
                    
                    @if (old('pasien_id') && old('pasien_id') == $value->id)
                        selected
                    @else
                        @if ($rekam_medis->pasien->id == $value->id)
                            selected
                        @endif
                    @endif
                >
                    {{ $value->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-2 mb-2">
        <label for="dokter_id" class="form-label">Nama Dokter</label>
        <select name="dokter_id" id="dokter_id" class="form-control">
            <option
                value=""
                disabled
                
                @if (old('dokter_id') == "")
                    selected
                @endif
            >
                Pilih satu...
            </option>
            
            @foreach ($dokter as $key => $value)
                <option
                    value="{{ $value->id }}"
                    
                    @if (old('dokter_id') && old('dokter_id') == $value->id)
                        selected
                    @else
                        @if ($rekam_medis->dokter->id == $value->id)
                            selected
                        @endif
                    @endif
                >
                    {{ $value->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-2 mb-2">
        <label for="kondisi_kesehatan" class="form-label">Kondisi Kesehatan</label>
        <textarea rows="5" class="form-control" type="text" placeholder="Kondisi Kesehatan" name="kondisi_kesehatan" id="kondisi_kesehatan"></textarea>
    </div>

    <div class="mt-2 mb-2">
        <label for="suhu_tubuh" class="form-label">Suhu Tubuh</label>
        <input class="form-control" type="number" placeholder="Suhu Tubuh" name="suhu_tubuh" id="suhu_tubuh"

        @if (old('suhu_tubuh'))
            value="{{ old('suhu_tubuh') }}"
        @else
            value="{{ $rekam_medis->suhu_tubuh }}"
        @endif
        >
    </div>

    <div class="mt-2 mb-5">
        <label for="file" class="form-label">File / Gambar Resep</label>
        <input class="form-control" type="file" name="file" id="file">
    </div>

    <input class="btn btn-primary" type="submit" value="Simpan Perubahan">
</form>

<script>
    const kondisi_kesehatan = document.getElementById('kondisi_kesehatan');

    @if (empty(old('kondisi_kesehatan')))
        kondisi_kesehatan.innerText = "{{ $rekam_medis->kondisi_kesehatan }}";
    @else
        kondisi_kesehatan.innerText = "{{ old('kondisi_kesehatan') }}";
    @endif
</script>

@endsection