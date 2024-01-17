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
                            <th>Role</th>
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
                            <th>Role</th>
                            <th>Active</th>
                            <th>Aksi</th>
                    </tfoot>
                    <tbody>
                        @foreach ($akuns as $no => $akun)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $akun['name'] }}</td>
                                <td>{{ $akun['username'] }}</td>
                                <td>{{ $akun['email'] }}</td>
                                <td>{{ $akun['no_hp'] }}</td>
                                <td>{{ $akun['role'] }}</td>
                                <td>{{ $akun->is_active ? 'Aktif' : 'NonAktif' }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning mb-3" data-toggle="modal"
                                        data-target="#editModal{{ $akun['id'] }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger mb-3" data-toggle="modal"
                                        data-target="#deleteModal{{ $akun['id'] }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal Edit-->
                            <div class="modal fade" id="#editModal{{ $akun['id'] }}" tabindex="-1" role="dialog"
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
                                                        <label for="">Role</label>
                                                        <input type="text" name="Role" class="form-control"
                                                            value="{{ $akun['Role'] }}">
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
                            <div class="modal fade" id="deleteModal{{ $akun['id'] }}" tabindex="-1" role="dialog"
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
                                                    <form action="{{ route('akun.destroy', $akun['id']) }}"
                                                        method="post">
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
    <form action="{{ route('akun.store') }}" method="post" enctype="multipart/form-data">
        <!-- Modal Tambah -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="k_password">Konfirmasi Password</label>
                                <input type="k_password" name="k_password" class="form-control" id="k_password"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp">Nomor HP</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Avatar</label>
                                <button type="button" class="form-control" data-toggle="modal"
                                    data-target="#imageModal">
                                    Pilih Profil
                                </button>
                                <input type="hidden" id="imageInput" name="gambar" />
                                <img id="selectedImage" width="100" class="img-thumbnail mt-2" alt="Selected Image">
                            </div>
                            <div class="col-md-3">
                                <label for="Role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Select an Image</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img width="100" src="/storage/profile/avatar1.png" value="avatar1.png" alt="Image 1"
                            class="img-thumbnail">
                        <img width="100" src="/storage/profile/avatar2.png" value="avatar2.png" alt="Image 2"
                            class="img-thumbnail">
                        <img width="100" src="/storage/profile/avatar3.png" value="avatar3.png" alt="Image 3"
                            class="img-thumbnail">
                        <img width="100" src="/storage/profile/avatar4.png" value="avatar4.png" alt="Image 4"
                            class="img-thumbnail">
                        <img width="100" src="/storage/profile/avatar5.png" value="avatar5.png" alt="Image 5"
                            class="img-thumbnail">
                        <img width="100" src="/storage/profile/avatar6.png" value="avatar6.png" alt="Image 6"
                            class="img-thumbnail">
                        <img width="100" src="/storage/profile/avatar7.png" value="avatar7.png" alt="Image 7"
                            class="img-thumbnail">
                        <img width="100" src="/storage/profile/avatar8.png" value="avatar8.png" alt="Image 8"
                            class="img-thumbnail">
                        <input type="file" name="gambar" id="customImageInput">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // Handle image selection
            $('.img-thumbnail').click(function() {
                var gambarUrl = $(this).attr('src');
                $('#imageInput').val(gambarUrl); // Set the image URL in the hidden input field
                $('#selectedImage').attr('src', gambarUrl); // Display the selected image
                $('#imageModal').modal('hide'); // Close the modal
            });

            // Handle custom image selection from file input
            $('#customImageInput').change(function() {
                var fileInput = $(this)[0];
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var gambarUrl = e.target.result;
                        $('#imageInput').val(
                            gambarUrl); // Set the image URL in the hidden input field
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            // Handle form submission
            $('form').submit(function() {
                var gambarUrl = $('#imageInput').val();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'gambar',
                    value: gambarUrl
                }).appendTo('form');
            });
        });
    </script>
@endsection
