@extends('admin/template/navbar')
@section('admin/content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Template
            </button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Template</th>
                            <th>Jenis Template</th>
                            <th>Nama Pembuat</th>
                            <th>HTML</th>
                            <th>CSS</th>
                            <th>JS</th>
                            <th>Views</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Template</th>
                            <th>Jenis Template</th>
                            <th>Nama Pembuat</th>
                            <th>HTML</th>
                            <th>CSS</th>
                            <th>JS</th>
                            <th>Views</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($templates as $no => $data)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/template-images/' . $data->gambar) }}" alt="Gambar Template"
                                        width="100">
                                </td>
                                <td>{{ $data->nama_template }}</td>
                                <td>
                                    @foreach ($data->tk as $value)
                                        <span class="badge badge-secondary">
                                            {{ $value->kategori->nama_kategori }}
                                        </span>
                                    @endforeach

                                </td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ Str::limit($data->html, 100, '...') }}</td>
                                <td>{{ Str::limit($data->css, 100, '...') }}</td>
                                <td>{{ Str::limit($data->js, 100, '...') }}</td>
                                <td>{{ $data->kunjungan }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning mb-1" data-toggle="modal"
                                        data-target="#editModal{{ $data->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $data->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this template?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('template.destroy', $data->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No,
                                                Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Template</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('template.update', $data->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_template">Nama Template</label>
                                                            <input type="text" name="nama_template" class="form-control"
                                                                id="nama_template" value="{{ $data->nama_template }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="id_kategori">Jenis Template</label>
                                                            <select name="id_kategori[]"
                                                                class="form-control js-example-basic-multiple" multiple
                                                                required>
                                                                @foreach ($kategori as $kategoriItem)
                                                                    <option value="{{ $kategoriItem->id }}"
                                                                        {{ in_array($kategoriItem->id, $id_kategori[$data->id] ?? []) ? 'selected' : '' }}>
                                                                        {{ $kategoriItem->nama_kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="user_id">Nama Pembuat</label>
                                                            <select name="user_id" class="form-control" id="user_id"
                                                                required>
                                                                <option value="">Pilih Pembuat</option>
                                                                @foreach ($akuns as $akun)
                                                                    <option value="{{ $akun->id }}"
                                                                        @if ($akun->id === $data->user_id) selected @endif>
                                                                        {{ $akun->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="html">Kode HTML</label>
                                                    <textarea name="html" class="form-control" id="html" required>{{ $data->html }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="css">Kode CSS</label>
                                                    <textarea name="css" class="form-control" id="css">{{ $data->css }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="js">Kode JS</label>
                                                    <textarea name="js" class="form-control" id="js">{{ $data->js }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gambar">Gambar</label><br>
                                                    <input type="file" name="gambar" class="form-control-file"
                                                        id="gambar">
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
                            <script>
                                $(document).ready(function() {
                                    $('#editModal{{ $data->id }}').on('shown.bs.modal', function() {
                                        $('.js-example-basic-multiple').select2({
                                            placeholder: 'Select options',
                                            maximumSelectionLength: 5
                                        });
                                    });
                                });
                            </script>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('template.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nama Template</label>
                                    <input type="text" name="nama_template" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Jenis Template</label>
                                    <select name="id_kategori[]" class="form-control js-example-basic-multiple" multiple>
                                        @foreach ($kategori as $no => $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nama Pembuat</label>
                                    <select name="nama_pembuat" class="form-control">
                                        <option value="">Pilih Pembuat</option>
                                        @foreach ($akuns as $no => $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addJenisTemplate">Kode HTML</label>
                            <textarea name="html" class="form-control" id="message"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="addJenisTemplate">Kode CSS</label>
                            <textarea name="css" class="form-control" id="message"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="addJenisTemplate">Kode JS</label>
                            <textarea name="js" class="form-control" id="message"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="addJenisTemplate">Gambar</label><br>
                            <input type="file" name="gambar" class="" id="addJenisTemplate">
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
    <script>
        $(document).ready(function() {
            $('#exampleModal').on('shown.bs.modal', function() {
                $('.js-example-basic-multiple').select2({
                    placeholder: 'Select options',
                    maximumSelectionLength: 5
                });
            });
        });
    </script>
@endsection
