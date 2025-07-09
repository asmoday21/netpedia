@extends('siswa.siswa_master')

@section('siswa')
<div class="container mt-4">
  <h4 class="mb-4">{{ $ujian->judul }}</h4>

  <form action="{{ route('siswa.ujian.submit', $ujian->id) }}" method="POST">
    @csrf
    @foreach ($ujian->soal as $index => $soal)
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <h5>Soal {{ $index + 1 }}</h5>
          <p>{!! nl2br(e($soal->pertanyaan)) !!}</p>

          @foreach (json_decode($soal->pilihan) as $key => $pilihan)
            <div class="form-check">
              <input class="form-check-input" type="radio" 
                     name="jawaban[{{ $soal->id }}]" 
                     id="jawaban-{{ $soal->id }}-{{ $key }}" 
                     value="{{ $key }}" required>
              <label class="form-check-label" for="jawaban-{{ $soal->id }}-{{ $key }}">
                {{ $pilihan }}
              </label>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
  </form>
</div>
@endsection
