@extends('admin.template.navbar')
@section('title', 'Data Setting')
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
    <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container my-4"
            style="background-color: azure; border: 1px solid #ccc;border-radius:10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); padding:15px;">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-4">
                        <label for="uploadFavicon" class="form-label">Upload Favicon</label><br>
                        <img src="{{ $setting['favicon'] }}" width="100" alt="Favicon" class="img-thumbnail me-3">
                        <label for="uploadFavicon" class="custom-file-upload">
                            <i class="fas fa-cloud-upload-alt"></i> Pilih Favicon
                        </label>
                        <input type="file" id="uploadFavicon" name="setting[favicon]" class="inputfile" accept="image/*">
                        <img id="previewFavicon" src="#" alt="Preview Favicon"
                            style="display: none; max-width: 100px; max-height: 100px;">

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="mb-4">
                        <div class="align-items-center justify-content-between">
                            <label for="">Nama / Judul : </label>
                            <input type="text" name="setting[nama]" value="{{ $setting['nama'] }}" class="form-control"
                                id="">
                        </div>
                    </div>
                    <hr>
                    <div class="mb-4">
                        <label for="">Meta : </label>
                        <input type="text" name="setting[meta_deskripsi]" value="{{ $setting['meta_deskripsi'] }}"
                            class="form-control" id="">
                    </div>
                    <hr>
                </div>
            </div>
            <button class="btn btn-info mx-auto" type="submit">Simpan</button>
        </div>
    </form>

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
@endsection
