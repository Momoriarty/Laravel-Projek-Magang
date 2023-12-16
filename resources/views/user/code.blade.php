@extends('user/template/navbar')

@section('user/content')
    <main id="main">
        <section id="sectionId" class="sectionClass">
            <div class="container mt-5">

                <div class="row mb-4">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari template...">
                        </div>
                    </div>
                </div>

                <!-- Tempat untuk menampilkan hasil pencarian -->
                <div class="row" id="searchResults">
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
                                                    <button type="submit" class="stretched-link text-decoration-none"
                                                        style="border: none; background:none;">
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

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            search();
        });

        function search() {
            // Mendapatkan nilai dari input pencarian
            var searchTerm = document.getElementById('searchInput').value.toLowerCase();

            // Mendapatkan elemen tempat hasil pencarian akan ditampilkan
            var searchResultsContainer = document.getElementById('searchResults');

            // Mengambil semua elemen di dalam container
            var elementsToSearch = searchResultsContainer.getElementsByClassName('template-card');

            // Menyaring elemen-elemen yang sesuai dengan kriteria pencarian
            for (var i = 0; i < elementsToSearch.length; i++) {
                var content = elementsToSearch[i].getAttribute('data-title').toLowerCase();

                // Memeriksa apakah isi elemen mengandung kata kunci pencarian
                if (content.includes(searchTerm)) {
                    // Jika iya, tampilkan elemen tersebut
                    elementsToSearch[i].style.display = '';
                } else {
                    // Jika tidak, sembunyikan elemen tersebut
                    elementsToSearch[i].style.display = 'none';
                }
            }
        }
    </script>
@endsection