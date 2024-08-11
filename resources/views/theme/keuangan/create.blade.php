@extends('layouts.admin.main')

@section('title', 'Tambah Judul')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('theme.index') }}">Judul</a></li>
    <li class="breadcrumb-item active" aria-current="page">
        Tambah
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    {{-- Tombol kembali --}}
                    <a href="{{ route('theme.keuangan.index', compact('theme')) }}" class="btn btn-default">Kembali</a>
                </div>
                <form action="{{ route('theme.keuangan.store', compact('theme')) }}" method="POST" class="form"
                    onsubmit="return confirm('Apakah anda yakin ??')">
                    <div class="card-body">
                        {{-- Agar tidak 419 expired, ketika di simpan --}}
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="publicationId">Publikasi</label>
                                    <select name="publicationId" id="publicationId" class="form-control"
                                        @error('publicationId') is-invalid @enderror>
                                        <option value="">-- Pilih Publikasi --</option>
                                        @foreach ($publications as $item)
                                            <option value="{{ $item->id }}"
                                                @if (old('publicationId') == $item->id) selected @endif>Cetakan
                                                Ke-{{ $item->numberOfPrinting }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('publicationId')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" value="{{ old('title') }}" readonly>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="productionCost">Biaya Produksi</label>
                                    <input type="number" class="form-control @error('productionCost') is-invalid @enderror"
                                        name="productionCost" id="productionCost" value="{{ old('productionCost') }}" readonly>
                                    @error('productionCost')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="income">Total Pemasukan</label>
                                    <input type="number" class="form-control @error('income') is-invalid @enderror"
                                        name="income" id="income" value="{{ old('income') }}">
                                    @error('income')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="percentAdmin">Admin (%)</label>
                                    <input type="number" class="form-control @error('percentAdmin') is-invalid @enderror"
                                        name="percentAdmin" id="percentAdmin" value="{{ old('percentAdmin') }}">
                                    @error('percentAdmin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="percentReviewer">Reviewer (%)</label>
                                    <input type="number"
                                        class="form-control @error('percentReviewer') is-invalid @enderror"
                                        name="percentReviewer" id="percentReviewer" value="{{ old('percentReviewer') }}">
                                    @error('percentReviewer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let publications = @json($publications);

        // On publicationId changed, fill name & productionCost
        document.querySelector('#publicationId').addEventListener('change', (event) => {
            const publication = publications.find(publication => publication.id == event.target.value);
            if (publication) {
                document.querySelector('#title').value =
                    `Cetakan Ke-${publication.numberOfPrinting} Tahun ${publication.productionYear}`;
                document.querySelector('#productionCost').value = publication.totalProduction * publication.price;
            }
        })
    </script>
@endsection
