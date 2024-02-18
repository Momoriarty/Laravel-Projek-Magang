@extends('admin/template/navbar')

@section('admin/content')
    <style>
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
            background-color: #f8f9fa;
            color: #495057;
        }

        .custom-file-upload:hover {
            background-color: #e9ecef;
        }

        .inputfile {
            display: none;
        }
    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Users Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Akun Yang terdaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i> <!-- Mengubah ikon sesuai -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Templates Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Upload</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $templates->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-upload fa-2x text-gray-300"></i> <!-- Mengubah ikon sesuai -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kategori->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i> <!-- Mengubah ikon sesuai -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#settingModal">
        Tambah Settingan
    </button>
    <div class="container">
        <div class="row">
            @forelse ($setting as $data)
                <div class="col-md-6 col-6">
                    <form action="{{ route('admin.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class=" my-4"
                            style="background-color: azure; border: 1px solid #ccc;border-radius:10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); padding:15px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label for="uploadFavicon_{{ $data->id }}" class="form-label">Upload
                                            Favicon</label><br>
                                        <img src="{{ $data->favicon }}" width="100" alt="Favicon"
                                            class="img-thumbnail me-3">
                                        <label for="uploadFavicon_{{ $data->id }}" class="custom-file-upload">
                                            <i class="fas fa-cloud-upload-alt"></i> Pilih Favicon
                                        </label>
                                        <input type="file" id="uploadFavicon_{{ $data->id }}" name="favicon"
                                            class="inputfile" accept="image/*">
                                        <img id="previewFavicon_{{ $data->id }}" src="#" alt="Preview Favicon"
                                            style="display: none; max-width: 100px; max-height: 100px;">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <div class="align-items-center justify-content-between">
                                            <label for="">Nama : </label>
                                            <input type="text" value="{{ $data->nama }}" name="nama"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-4">
                                        <label for="">Meta : </label>
                                        <input type="text" value="{{ $data->meta }}" name="meta"
                                            class="form-control">
                                    </div>
                                    <hr>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-6 mb-2">
                                            <label for="status" class="form-label">Status:</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Tidak
                                                    Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info mx-auto" type="submit">Save</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal_{{ $data->id }}">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>





                <!-- Modal delete -->
                <div class="modal fade" id="deleteModal_{{ $data->id }}" tabindex="-1"
                    aria-labelledby="settingModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="settingModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <i class="fas fa-exclamation-triangle text-danger fs-1 mb-3"></i>
                                    <p class="lead">Anda yakin ingin menghapus item ini?</p>
                                    <p>Item yang dihapus tidak dapat dikembalikan.</p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form action="{{ route('admin.destroy', $data->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">Hapus</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container my-4"
                        style="background-color: azure; border: 1px solid #ccc;border-radius:10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); padding:15px;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label for="uploadFavicon" class="form-label">Upload Favicon</label><br>
                                    <img src="" width="100" alt="Favicon" class="img-thumbnail me-3">
                                    <label for="uploadFavicon" class="custom-file-upload">
                                        <i class="fas fa-cloud-upload-alt"></i> Pilih Favicon
                                    </label>
                                    <input type="file" id="uploadFavicon" name="favicon" class="inputfile"
                                        accept="image/*">
                                    <img id="previewFavicon" src="#" alt="Preview Favicon"
                                        style="display: none; max-width: 100px; max-height: 100px;">

                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <div class="align-items-center justify-content-between">
                                        <label for="">Nama / Judul : </label>
                                        <input type="text" name="nama" class="form-control" id="">
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-4">
                                    <label for="">Meta : </label>
                                    <input type="text" name="meta" class="form-control" id="">
                                </div>
                                <hr>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status:</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-info mx-auto" type="submit">Simpan</button>
                    </div>
                </form>
            @endforelse
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="settingModal" tabindex="-1" aria-labelledby="settingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="settingModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container my-4"
                            style="background-color: azure; border: 1px solid #ccc;border-radius:10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); padding:15px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label for="uploadFavicon" class="form-label">Upload Favicon</label><br>
                                        <img src="" width="100" alt="Favicon" class="img-thumbnail me-3">
                                        <label for="uploadFavicon" class="custom-file-upload">
                                            <i class="fas fa-cloud-upload-alt"></i> Pilih Favicon
                                        </label>
                                        <input type="file" id="uploadFavicon" name="favicon" class="inputfile"
                                            accept="image/*">
                                        <img id="previewFavicon" src="#" alt="Preview Favicon"
                                            style="display: none; max-width: 100px; max-height: 100px;">

                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <div class="align-items-center justify-content-between">
                                            <label for="">Nama / Judul : </label>
                                            <input type="text" name="nama" class="form-control" id="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-4">
                                        <label for="">Meta : </label>
                                        <input type="text" name="meta" class="form-control" id="">
                                    </div>
                                    <hr>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status:</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Grafik -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Data</h6>
                </div>
                <div class="card-body">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabel Interaktif -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Content Row -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users', 'Templates', 'Categories'],
                datasets: [{
                    label: 'Total',
                    data: [{{ $users->count() }}, {{ $templates->count() }}, {{ $kategori->count() }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @forelse ($setting as $data)
        <script>
            // Ambil elemen input file
            const inputFavicon_{{ $data->id }} = document.getElementById('uploadFavicon_{{ $data->id }}');

            // Ambil elemen gambar untuk menampilkan pratinjau
            const previewFavicon_{{ $data->id }} = document.getElementById('previewFavicon_{{ $data->id }}');

            // Tambahkan event listener untuk input file
            inputFavicon_{{ $data->id }}.addEventListener('change', function() {
                // Pastikan ada file yang dipilih
                if (this.files && this.files[0]) {
                    // Baca URL gambar yang dipilih
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Tampilkan pratinjau gambar
                        previewFavicon_{{ $data->id }}.src = e.target.result;
                        previewFavicon_{{ $data->id }}.style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        </script>
    @empty
    @endforelse
    <script>
        // Ambil elemen input file
        const inputFavicon = document.getElementById('uploadFavicon');

        // Ambil elemen gambar untuk menampilkan pratinjau
        const previewFavicon = document.getElementById('previewFavicon');

        // Tambahkan event listener untuk input file
        inputFavicon.addEventListener('change', function() {
            // Pastikan ada file yang dipilih
            if (this.files && this.files[0]) {
                // Baca URL gambar yang dipilih
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Tampilkan pratinjau gambar
                    previewFavicon.src = e.target.result;
                    previewFavicon.style.display = 'block';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    <!-- Script untuk Tabel Interaktif -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
@endsection
