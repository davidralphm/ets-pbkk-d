@extends('rekammedis.base')

@section('title', 'Buat Rekam Medis')

@section('content')

@section('heading', 'Buat Rekam Medis')

<form action="/rekamMedis" method="post" enctype="multipart/form-data" class="container p-4">
    {{ csrf_field() }}

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
                    
                    @if (old('pasien_id') == $value->id)
                        selected
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
                    
                    @if (old('dokter_id') == $value->id)
                        selected
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
        <input class="form-control" type="decimal" placeholder="Suhu Tubuh" name="suhu_tubuh" id="suhu_tubuh" value="{{ old('suhu_tubuh') }}">
    </div>

    <div class="mt-2 mb-5">
        <label for="file" class="form-label">File / Gambar Resep</label>
        <input class="form-control" type="file" name="file" id="file">
    </div>

    <input class="btn btn-primary" type="submit" value="Buat Rekam Medis">
</form>

<script>
    const kondisiKesehatan = document.getElementById('kondisi_kesehatan');

    kondisiKesehatan.textContent = "{{ htmlspecialchars(old('kondisi_kesehatan')) }}";
</script>

@endsection