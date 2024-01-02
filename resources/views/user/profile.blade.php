@extends('user/template/navbar')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<style>
    .profile-container {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        margin-top: 70px;
    }

    .profile-picture {
        max-width: 200px;
    }

    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .btn-upload {
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .file-chosen {
        margin-top: 10px;
    }

    .modal-content {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modal-title {
        color: #000;
    }

    .modal-footer {
        border-top: 1px solid #dee2e6;
    }

    .upload-btn {
        background: linear-gradient(to right, #FFD700, #FF6347);
        color: #fff;
        transition: background 0.3s ease;
        border-radius: 50px;
    }

    .upload-btn:hover {
        background: linear-gradient(to right, #FF6347, #FFD700);
        color: #fff;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .custom-fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    .custom-hover {
        transition: transform 0.3s ease-in-out;
    }

    .custom-hover:hover {
        transform: scale(1.1);
    }

    .animated-content {
        display: inline-block;
        transition: transform 0.3s ease-in-out;
    }

    .float-right .upload-btn {
        float: right;
        border-radius: 50px;
        /* Atur sesuai keinginan Anda */
    }

    .float-right .animated-content {
        transform-origin: top right;
    }

    .float-right .upload-btn:hover .animated-content {
        transform: scale(1.1) translateX(20%);
    }


    .upload-btn,
    .animated-content {
        overflow: hidden;
    }
</style>

<div class="container profile-container">
    <div class="row">
        <div class="col-md-4">
            <!-- Foto Profil -->
            <img src=" {{ $akuns->profile }}" alt="Profile Picture" class="img-fluid rounded-circle profile-picture"
                width="250">
        </div>
        <div class="col-md-4">
            <!-- Nama Pengguna -->
            {{ ucfirst($akuns->name) }}
            <!-- Informasi Profil -->
            <ul class="list-unstyled">
                <li><strong>Username:</strong> {{ ucfirst($akuns->username) }}</li>
                <li><strong>Email:</strong> {{ $akuns->email }}</li>
                <li><strong>No HandPhone:</strong> {{ $akuns->no_hp }}</li>
            </ul>


        </div>
        <div class="col-md-4">
            <button type="button" data-toggle="modal" data-target="#editProfileModal"
                class="btn btn-lg d-block mx-auto mt-4 p-3 rounded-pill shadow upload-btn float-right">
                <span class="animated-content">
                    <i class="fas fa-fw fa-user-edit"></i>
                </span>
            </button>
            <button type="button" data-toggle="modal" data-target="#editProfileModal"
                class="btn btn-lg d-block mx-auto mt-4 p-3 rounded-pill shadow upload-btn float-right">
                <span class="animated-content">
                    <i class="fas fa-fw fa-edit"></i>
                </span>
            </button>
        </div>

    </div>
    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Input fields for editing profile -->
                    <div class="form-group">
                        <label for="Name">Name:</label>
                        <input type="text" class="form-control" id="Name" value="{{ $akuns->name }}"
                            name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="Username">Username:</label>
                        <input type="text" class="form-control" id="Username" value="{{ $akuns->username }}"
                            name="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email:</label>
                        <input type="email" class="form-control" id="Email" value="{{ $akuns->email }}"
                            name="email" placeholder="Enter your email">
                    </div>
                    <!-- Add more input fields as needed -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    <button type="button" data-toggle="modal" data-target="#uploadModal"
        class="btn btn-lg d-block mx-auto mt-4 p-3 rounded-pill shadow upload-btn">
        <span class="animated-content">
            <span class="mr-2">🚀</span> Upload Template <span class="ml-2">🌟</span>
        </span>
    </button>

    <!-- Modal Upload Template -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Unggah Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="addNamaTemplate">Nama Template</label>
                                    <input type="text" name="nama_template" class="form-control"
                                        id="addNamaTemplate" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="addJenisTemplate">Jenis Template</label>
                                    <input type="text" name="jenis_template" class="form-control"
                                        id="addJenisTemplate" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="htmlTextarea">Kode HTML</label>
                            <textarea name="html" class="form-control" id="htmlTextarea"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cssTextarea">Kode CSS</label>
                            <textarea name="css" class="form-control" id="cssTextarea"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="jsTextarea">Kode JS</label>
                            <textarea name="js" class="form-control" id="jsTextarea"></textarea>
                        </div>
                        <div class="upload-btn-wrapper">
                            <button class="btn-upload">Pilih File</button>
                            <input type="file" name="gambar" id="templateFile" class="file-input">
                        </div>
                        <p class="file-chosen">Belum ada file yang dipilih</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Unggah Template</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk menampilkan nama file yang dipilih
        document.getElementById('templateFile').addEventListener('change', function() {
            const fileName = this.files[0].name;
            document.querySelector('.file-chosen').innerText = fileName;
        });
    </script>

</div>
</div>

<div class="container mt-5 ">

    <h3 style="text-align: center; color:rgb(227, 198, 198);">Template Saya</h3>
    <div class="row justify-content-center">
        @forelse ($template as $no => $data)
            <div class="col-lg-3 col-md-3 col-6 mb-5 template-card" data-title="{{ $data->nama_template }}">
                <div class="card h-100 shadow border-0">
                    <img class="card-img-top" src="{{ asset('storage/template-images/' . $data->gambar) }}"
                        alt="{{ $data->nama_template }}">
                    <div class="card-body p-4">
                        <a class="text-decoration-none link-dark" href="/code/{{ $data->id }}">
                            <h3 class="card-title">{{ $data->nama_template }}</h3>
                            <div class="text-muted">
                                <i class="bi bi-person"></i>{{ $data->user->name }}
                            </div>
                        </a>
                        <div class="text-muted" style="margin-top: 3px;">
                            <i class="bi bi-eye"></i> {{ $data->kunjungan }}
                        </div>
                    </div>

                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                        <div class="d-flex align-items-end justify-content-between">

                            <div class="d-flex align-items-center">
                                <div class="small">
                                    <form action="{{ route('code.update', $data->id) }}" method="post"
                                        style="display: inline-block;">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="kunjungan" value="1">
                                        <button type="submit" class="text-decoration-none btn btn-link">
                                            Check Code <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </form>

                                    <!-- Edit Button (Modal Trigger) -->
                                    <button type="button" class="ml-2 btn btn-link text-decoration-none"
                                        data-toggle="modal" data-target="#editModal{{ $data->id }}">
                                        Edit <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- Delete Button (Modal Trigger) -->
                                    <button type="button" class="ml-2 btn btn-link text-decoration-none"
                                        data-toggle="modal" data-target="#deleteModal{{ $data->id }}">
                                        Delete <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


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
                        <form action="{{ route('profile.update', $data->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="editNamaTemplate">Nama Template</label>
                                            <input type="text" name="nama_template" class="form-control"
                                                id="editNamaTemplate" value="{{ $data->nama_template }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="editJenisTemplate">Jenis Template</label>
                                            <input type="text" name="jenis_template" class="form-control"
                                                id="editJenisTemplate" value="{{ $data->jenis_template }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="editNamaPembuat">Nama Pembuat</label>
                                            <input type="text" class="form-control" readonly name="nama_pembuat"
                                                value="{{ $akuns->name }}">

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
                                    <input type="file" name="gambar" class="form-control" id="editGambar">
                                </div>
                                <!-- Add other fields as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this template?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('profile.destroy', $data->id) }}" method="post">
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
        @empty
            <div class="text-center my-5 text-light">
                <p class="lead">Oops! Tidak ada template yang tersedia saat ini.</p>
                <p class="text">Coba buat template baru atau kembali lagi nanti untuk melihat koleksi yang lebih
                    lengkap.</p>
            </div>
        @endforelse


    </div>
</div>


<script>
    document.getElementById('templateFile').addEventListener('change', function() {
        var fileName = this.value.split('\\').pop();
        var fileChosen = document.querySelector('.file-chosen');
        fileChosen.textContent = fileName ? 'File: ' + fileName : 'Belum ada file yang dipilih';
    });
</script>
