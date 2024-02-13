<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"></script>

<!-- Atur tema yang diinginkan (misalnya, 'darcula') -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/darcula.min.css">

<script>
    hljs.initHighlightingOnLoad();
</script>


@extends('user/template/navbar')
@section('user/content')
    <div class="main">
        <section>
            <div class="container-fluid px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-12">
                        <article>
                            <header class="mb-4" style="color: rgba(210, 210, 210, 0.705)">
                                <h1 class="fw-bolder mb-1">{{ $Templates->nama_template }}</h1>
                                <div class="fst-italic mb-2">{{ $Templates->created_at }} &nbsp<i
                                        class="bi bi-eye"></i>{{ $Templates->kunjungan }}</div>
                                @foreach ($Templates->tk as $value)
                                    <p class="badge bg-primary text-decoration-none">
                                        {{ $value->kategori->nama_kategori }}
                                    </p>
                                @endforeach
                            </header>
                        </article>
                    </div>
                </div>
                <div class="row gx-5">
                    <div class="col-lg-6">
                        <figure class="mb-4">
                            <div class="portfolio-img">
                                <div class="background-img"
                                    style="background-image: url('{{ asset('storage/template-images/' . $Templates->gambar) }}');">
                                </div>
                                <div class="img-overlay">
                                    <img src="{{ asset('storage/template-images/' . $Templates->gambar) }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
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
                        <a href="{{ '/live-demo/' . $Templates->id }}" target="_blank" class="btn btn-info">Live
                            Demo</a>
                    </div>
                </div>


                <div class="row">
                    <h5 class="text-white">index.html
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('htmlTextarea')">Copy</button>
                    </h5>
                    <pre><code id="htmlTextarea" class="hljs html" oninput="adjustTextareaHeight('htmlTextarea')">{{ $Templates->html }}</code></pre>
                </div>

                <div class="row">
                    <h5 class="text-white">styles.css
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('cssTextarea')">Copy</button>
                    </h5>
                    <pre><code id="cssTextarea" class="hljs css"
                            oninput="adjustTextareaHeight('cssTextarea')">{{ $Templates->css }}</code></pre>
                </div>

                <div class="row">
                    <h5 class="text-white">script.js
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('jsTextarea')">Copy</button>
                    </h5>
                    <pre><code id="jsTextarea" class="hljs javascript"
                            oninput="adjustTextareaHeight('jsTextarea')">{{ $Templates->js }}</code></pre>
                </div>

            </div>
        </section>
    </div>

    <script>
        function copyToClipboard(elementId) {
            var textarea = document.getElementById(elementId);
            var range = document.createRange();
            range.selectNode(textarea);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();

            // Menampilkan notifikasi
            var notification = document.createElement('div');
            notification.textContent = 'Teks berhasil disalin!';
            notification.style.position = 'fixed';
            notification.style.top = '10px';
            notification.style.left = '50%';
            notification.style.transform = 'translateX(-50%)';
            notification.style.backgroundColor = 'rgba(0, 255, 0, 0.7)';
            notification.style.padding = '10px 20px';
            notification.style.borderRadius = '5px';
            notification.style.color = '#fff';
            notification.style.zIndex = '9999';
            document.body.appendChild(notification);

            // Menghilangkan notifikasi setelah beberapa detik
            setTimeout(function() {
                notification.remove();
            }, 3000);
        }

        function adjustTextareaHeight(elementId) {
            var textarea = document.getElementById(elementId);
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight + 5) + 'px';
        }
    </script>
