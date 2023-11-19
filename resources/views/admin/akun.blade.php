@extends('admin/template/navbar')
@section('admin/content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Akun
            </button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Level</th>
                            <th>Active</th>
                            <th>Aksi</th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Level</th>
                            <th>Active</th>
                            <th>Aksi</th>
                    </tfoot>
                    <tbody>
                        @foreach ($akuns as $akun)
                            <tr>
                                <td>{{ $akun['id'] }}</td>
                                <td>{{ $akun['name'] }}</td>
                                <td>{{ $akun['username'] }}</td>
                                <td>{{ $akun['email'] }}</td>
                                <td>{{ $akun['no_hp'] }}</td>
                                <td>{{ $akun['level'] }}</td>
                                <td>{{ $akun->is_active ? 'Aktif' : 'NonAktif' }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning mb-3" data-toggle="modal"
                                        data-target="#editModal{{ $akun['id'] }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger mb-3" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal Edit-->
                            <div class="modal fade" id="#deleteModal{{ $akun['id'] }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('akun.update', $akun['id']) }}" method="post">
                                            @method('PUT') {{-- Atau @method('PATCH') --}}
                                            @csrf

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $akun['name'] }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Username</label>
                                                        <input type="text" name="username" class="form-control"
                                                            value="{{ $akun['username'] }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Password</label>
                                                        <input type="text" name="password" class="form-control"
                                                            value="{{ $akun['password'] }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Email</label>
                                                        <input type="text" name="email" class="form-control"
                                                            value="{{ $akun['email'] }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">No Hp</label>
                                                        <input type="text" name="no_hp" class="form-control"
                                                            value="{{ $akun['no_hp'] }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Level</label>
                                                        <input type="text" name="level" class="form-control"
                                                            value="{{ $akun['level'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit-->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <h1 class="text-danger">Konfirmasi Penghapusan</h1>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 text-center">
                                                    <p>Anda yakin ingin menghapus data ini?</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 text-center">
                                                    <!-- Tombol submit atau konfirmasi penghapusan -->
                                                    <form action="{{ route('akun.destroy') }}" method="post">
                                                        @method('DELETE') {{-- Digunakan untuk menandai bahwa ini adalah metode DELETE --}}
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus
                                                            Data</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tidak,
                                                            Batalkan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('akun.store') }}" method="post">
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-12">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" required>
                            </div>
                            <div class="col-md-12">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="col-md-12">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-12">
                                <label for="no_hp">Nomor HP</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp" required>
                            </div>
                            <div class="col-md-12">
                                <label for="level">Level</label>
                                <input type="text" name="level" class="form-control" id="level" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
