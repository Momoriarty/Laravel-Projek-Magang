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

    .upload-btn:hover .animated-content {
        transform: scale(1.1);
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
            <img src="path/to/profile-picture.jpg" alt="Profile Picture"
                class="img-fluid rounded-circle profile-picture">
        </div>
        <div class="col-md-8">
            <!-- Nama Pengguna -->
            <h2>{{ Auth::user()->name }}</h2>

            <!-- Informasi Profil -->
            <ul class="list-unstyled">
                <li><strong>Pekerjaan:</strong> Web Developer</li>
                <li><strong>Tempat Tinggal:</strong> Kota Anda</li>
                <li><strong>Asal:</strong> Asal Anda</li>
            </ul>


        </div>
    </div>

    <!-- Status/Pos Terbaru -->
    <div class="row mt-3">
        <div class="col-md-12">
            <h4>Template Anda</h4>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et justo
                                vitae
                                justo faucibus euismod.</p>
                            <p class="card-text">Nulla facilisi. Vestibulum id turpis ac felis commodo viverra. Duis
                                condimentum
                                lacus nec risus fermentum, a ullamcorper leo dignissim. Nulla facilisi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et justo
                                vitae
                                justo faucibus euismod.</p>
                            <p class="card-text">Nulla facilisi. Vestibulum id turpis ac felis commodo viverra. Duis
                                condimentum
                                lacus nec risus fermentum, a ullamcorper leo dignissim. Nulla facilisi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et justo
                                vitae
                                justo faucibus euismod.</p>
                            <p class="card-text">Nulla facilisi. Vestibulum id turpis ac felis commodo viverra. Duis
                                condimentum
                                lacus nec risus fermentum, a ullamcorper leo dignissim. Nulla facilisi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Start -->

            <!-- Card End -->

        </div>
    </div>


    <button type="button" data-toggle="modal" data-target="#uploadModal"
        class="btn btn-lg d-block mx-auto mt-4 p-3 rounded-pill shadow upload-btn">
        <span class="animated-content">
            <span class="mr-2">🚀</span> Upload Template <span class="ml-2">🌟</span>
        </span>
    </button>

    <!-- Upload Template Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="addNamaTemplate">Nama Template</label>
                                    <input type="text" name="nama_template" class="form-control" id="addNamaTemplate"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="addJenisTemplate">Jenis Template</label>
                                    <input type="text" name="jenis_template" class="form-control"
                                        id="addJenisTemplate" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="addNamaTemplate">Nama Pembuat</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                        readonly>
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

                        <div class="upload-btn-wrapper">
                            <button class="btn-upload">Pilih File</button>
                            <input type="file" name="templateFile" id="templateFile" class="file-input" required>
                        </div>
                        <p class="file-chosen">Belum ada file yang dipilih</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Upload Template</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById('templateFile').addEventListener('change', function() {
        var fileName = this.value.split('\\').pop();
        var fileChosen = document.querySelector('.file-chosen');
        fileChosen.textContent = fileName ? 'File: ' + fileName : 'Belum ada file yang dipilih';
    });
</script>
@extends('user/template/footer')
