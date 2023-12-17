@extends('user/template/navbar')
@section('user/content')
    <div class="main">
        <section>
            <div class="container-fluid px-5 my-5 ">
                <div class="row gx-5">
                    <div class="col-lg-12">
                        <article>
                            <header class="mb-4" style="color: rgba(210, 210, 210, 0.705)">
                                <h1 class="fw-bolder mb-1">{{ $Templates->nama_template }}</h1>
                                <div class="fst-italic mb-2">{{ $Templates->created_at }} &nbsp<i class="bi bi-eye">
                                    </i>{{ $Templates->kunjungan }}</div>
                                <p class="badge bg-primary text-decoration-none">HTML</p>
                                <p class="badge bg-primary text-decoration-none">CSS</p>
                                <p class="badge bg-primary text-decoration-none">Login form</p>
                            </header>
                        </article>
                    </div>
                </div>
                <div class="row gx-5">
                    <div class="col-lg-6">
                        <figure class="mb-4">
                            <img class="img-fluid rounded"
                                src="{{ asset('storage/template-images/' . $Templates->gambar) }}" style="width:100%"
                                alt="Login" title="Login" />
                        </figure>
                    </div>
                    <div class="col-lg-6" style="color: white">
                        <h2 class="fw-bolder mb-4">Recommended</h2>
                        @foreach ($rekomendasi as $data)
                            <div class="mb-4">
                                <div class="small ">{{ $data->created_at }}</div>
                                <a class="link-light nl" href="{{ '/code/' . $data->id }}">
                                    <h3>{{ $data->nama_template }}</h3>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <a href="{{ '/live-demo/' . $Templates->id }}" class="btn btn-info">LiVe Demo</a>
                    </div>
                </div>

                <div class="row">
                    <h5>index.html
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('htmlTextarea')">Copy</button>
                    </h5>
                    <textarea readonly id="htmlTextarea" oninput="adjustTextareaHeight('htmlTextarea')" rows="30" cols="50">{{ $Templates->html }}</textarea>
                </div>

                <div class="row">
                    <h5>styles.css
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('cssTextarea')">Copy</button>
                    </h5>
                    <textarea readonly id="cssTextarea" oninput="adjustTextareaHeight('cssTextarea')" rows="30" cols="50">{{ $Templates->css }}</textarea>
                </div>

                <div class="row">
                    <h5>script.js
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('jsTextarea')">Copy</button>
                    </h5>
                    <textarea readonly id="jsTextarea" oninput="adjustTextareaHeight('jsTextarea')" rows="10" cols="50">{{ $Templates->js }}</textarea>
                </div>

            </div>
        </section>
    </div>


    <script>
        function copyToClipboard(textareaId) {
            var textarea = document.getElementById(textareaId);
            textarea.select();
            textarea.setSelectionRange(0, 99999); /* For mobile devices */
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
        }

        function adjustTextareaHeight(textareaId) {
            var textarea = document.getElementById(textareaId);
            textarea.style.height = 'auto'; // Resetting height to auto to recalculate the actual height
            textarea.style.height = (textarea.scrollHeight) + 'px';
        }
    </script>
@endsection
