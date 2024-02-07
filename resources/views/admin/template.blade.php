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
                                <td>{{ $data->jenis_template }}</td>
                                <td>{{ $data->nama_pembuat }}</td>
                                <td>{{ $data->html }}</td>
                                <td>{{ $data->css }}</td>
                                <td>{{ $data->js }}</td>
                                <td>{{ $data->kunjungan }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning mb-1" data-toggle="modal"
                                        data-target="#editModal{{ $data->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger mb-1" data-toggle="modal"
                                        data-target="#deleteModal{{ $data->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Template</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('template.update', $data->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="editNamaTemplate">Nama Template</label>
                                                            <input type="text" name="nama_template" class="form-control"
                                                                id="editNamaTemplate" value="{{ $data->nama_template }}"
                                                                >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="editJenisTemplate">Jenis Template</label>
                                                            <input type="text" name="jenis_template" class="form-control"
                                                                id="editJenisTemplate" value="{{ $data->jenis_template }}"
                                                                >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="editNamaPembuat">Nama Pembuat</label>
                                                            <select name="nama_pembuat" class="form-control">
                                                                <option value="">Pilih Pembuat</option>
                                                                @foreach ($akuns as $no => $data)
                                                                    <option value="{{ $data->name }}">
                                                                        {{ $data->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editHTML">Kode HTML</label>
                                                    <textarea name="html" class="form-control" id="editHTML">{{ $data->html }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editCSS">Kode CSS</label>
                                                    <textarea name="css" class="form-control" id="editCSS">{{ $data->css }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editJS">Kode JS</label>
                                                    <textarea name="js" class="form-control" id="editJS">{{ $data->js }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editGambar">Gambar</label><br>
                                                    <img src="{{ asset('storage/template-images/' . $data->gambar) }}"
                                                        alt="Current Image"
                                                        style="max-width: 150px; max-height: 150px; margin-bottom: 10px;">
                                                    <input type="file" name="gambar" class="form-control"
                                                        id="editGambar">
                                                </div>
                                                <!-- Add other fields as needed -->
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


                            <!-- Modal Delete-->
                            <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Template</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
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
                                    <label for="addNamaTemplate">Nama Template</label>
                                    <input type="text" name="nama_template" class="form-control" id="addNamaTemplate"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="addJenisTemplate">Jenis Template</label>
                                    <input type="text" name="jenis_template" class="form-control"
                                        id="addJenisTemplate" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="addNamaTemplate">Nama Pembuat</label>
                                    <select name="nama_pembuat" class="form-control">
                                        <option value="">Pilih Pembuat</option>
                                        @foreach ($akuns as $no => $data)
                                            <option value="{{ $data->name }}">
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
                            <input type="file" name="gambar" class="" id="addJenisTemplate" >
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
