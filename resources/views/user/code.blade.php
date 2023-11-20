@extends('user/template/navbar')

@section('user/content')
    <main id="main">
        <section id="#" class="#">
            <div class="container mt-5">

                <div class="row mb-4">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari template...">
                        </div>
                    </div>
                </div>

                <div class="row" id="searchResults">
                    <!-- Tempat untuk menampilkan hasil pencarian -->
                    @foreach ($Templates as $no => $data)
                        <div class="col-lg-3 col-md-3 col-6 mb-5 template-card" data-title="{{ $data->nama_template }}">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="{{ asset('storage/template-images/' . $data->gambar) }}"
                                    alt="{{ $data->nama_template }}">
                                <div class="card-body p-4">
                                    <a class="text-decoration-none link-dark stretched-link"
                                        href="/code/{{ $data->id }}">
                                        <h3 class="card-title">{{ $data->nama_template }}</h3>
                                        <div class="text-muted">
                                            <i class="bi bi-person"></i>{{ $data->nama_pembuat }}
                                        </div>
                                    </a>
                                </div>
                                <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                    <div class="d-flex align-items-end justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="small">
                                                <form action="{{ route('code.update', $data->id) }}" method="post">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="kunjungan" value="1">
                                                    <button type="submit" class="stretched-link text-decoration-none" style="border: none; background:none;">
                                                        Check Code <i class="bi bi-arrow-right"></i>
                                                    </button>
                                                </form>
                                                {{-- <a class="stretched-link text-decoration-none"
                                                    href="/code/{{ $data->id }}">
                                                    Check Code <i class="bi bi-arrow-right"></i>
                                                </a> --}}
                                                <div class="text-muted" style="margin-top: 3px;">
                                                    <i class="bi bi-eye"></i> {{ $data->kunjungan }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var query = $(this).val().toLowerCase();

                // Mencari template yang sesuai dengan judul
                $('.template-card').each(function() {
                    var title = $(this).data('title').toLowerCase();
                    if (title.includes(query)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endsection
