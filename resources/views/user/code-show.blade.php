@extends('user/template/navbar')
@section('user/content')
    <div class="main">
        <section>
            <div class="container-fluid px-5 my-5 ">
                <div class="row gx-5">
                    <div class="col-lg-12">
                        <article>
                            <header class="mb-4" style="color: rgba(210, 210, 210, 0.705)">
                                <h1 class="fw-bolder mb-1">Login</h1>
                                <div class="fst-italic mb-2">{{ $Templates->created_at }} <i class="bi bi-eye"></i>174</div>
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
                        <div class="mb-4">
                            <div class="small ">18 March 2023</div>
                            <a class="link-light nl" href="/code/19">
                                <h3>Modern Login Form</h3>
                            </a>
                        </div>
                        <div class="mb-4">
                            <div class="small ">25 April 2023</div>
                            <a class="link-light nl" href="/code/29">
                                <h3>Responsive Login Form</h3>
                            </a>
                        </div>
                        <div class="mb-4">
                            <div class="small ">2 March 2023</div>
                            <a class="link-light nl" href="/code/12">
                                <h3>Simple Login Form</h3>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <h5>index.html
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('myTextarea')">Copy</button>
                    </h5>
                    <textarea id="myTextarea">{{ $Templates->html }}</textarea>
                </div>
                <div class="row">
                    <h5>index.html
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('myTextarea')">Copy</button>
                    </h5>
                    <textarea id="myTextarea">{{ $Templates->css }}</textarea>
                </div>
                <div class="row">
                    <h5>index.html
                        <button class="btn copy-button" style="margin-left: 8px;color:yellowgreen;"
                            onclick="copyToClipboard('myTextarea')">Copy</button>
                    </h5>
                    <textarea id="myTextarea">{{ $Templates->js }}</textarea>
                </div>
            </div>
        </section>
    </div>
@endsection
