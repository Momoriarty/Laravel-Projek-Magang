@extends('user/template/navbar')
@section('title', 'The Code')
@section('user/content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1>Better Solutions For Your Website</h1>
                    @if (Auth::check())
                        <h2>Halo, {{ ucwords(Auth::user()->name) }}! Selamat datang.</h2>
                    @else
                        <h2>Selamat datang</h2>
                    @endif
                    {{-- <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div> --}}
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ '' }}assets/user/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Website Penyediaan Template Code</h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6">
                        <p class="text-white">
                            Kami adalah penyedia template code berkualitas tinggi untuk kebutuhan pengembangan perangkat
                            lunak Anda. Dengan berbagai pilihan template yang tersedia, Anda dapat dengan mudah menemukan
                            solusi yang sesuai dengan proyek Anda.
                        </p>
                        <ul class="text-white">
                            <li><i class="ri-check-double-line"></i> Template yang dirancang dengan baik dan mudah untuk
                                disesuaikan</li>
                            <li><i class="ri-check-double-line"></i> Dukungan teknis yang responsif dan ramah</li>
                            <li><i class="ri-check-double-line"></i> Berbagai macam jenis template untuk berbagai keperluan
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <p class="text-white">
                            Kami berkomitmen untuk memberikan pengalaman pengguna yang optimal. Setiap template yang kami
                            sediakan telah melalui proses seleksi yang ketat untuk memastikan kualitasnya. Jadikan proyek
                            Anda lebih efisien dengan menggunakan template code dari kami.
                        </p>
                        <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us section-bg">
            <div class="container-fluid" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1">
                        <div class="content">
                            <h3>Mengapa Memilih Kami <strong>sebagai Penyedia Template Code</strong></h3>
                            <p class="text-dark">
                                Kami menyediakan template code berkualitas tinggi untuk memenuhi kebutuhan pengembangan
                                perangkat lunak Anda. Berikut beberapa alasan mengapa Anda harus memilih kami:
                            </p>
                        </div>
                        <div class="accordion-list">
                            <ul>
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse"
                                        data-bs-target="#accordion-list-1"><span>01</span> Template Code yang Berkualitas <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                        <p>
                                            Kami memastikan setiap template code yang kami sediakan telah melalui proses
                                            seleksi ketat untuk memastikan kualitasnya. Dengan demikian, Anda dapat
                                            mempercayai keandalan dan kestabilan kode kami.
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2"
                                        class="collapsed"><span>02</span> Dukungan Teknis yang Responsif <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Tim dukungan teknis kami siap membantu Anda dalam memecahkan masalah dan
                                            menjawab pertanyaan yang Anda miliki seputar penggunaan template code kami. Kami
                                            berkomitmen untuk memberikan layanan yang responsif dan ramah kepada pelanggan
                                            kami.
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3"
                                        class="collapsed"><span>03</span> Beragam Jenis Template <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Kami menyediakan berbagai macam jenis template code untuk berbagai keperluan,
                                            mulai dari website bisnis hingga aplikasi mobile. Dengan begitu, Anda dapat
                                            dengan mudah menemukan template yang sesuai dengan kebutuhan proyek Anda.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                        style='background-image: url("{{ '' }}assets/user/img/why-us.png");' data-aos="zoom-in"
                        data-aos-delay="150">&nbsp;</div>
                </div>
            </div>
        </section><!-- End Why Us Section -->


        <!-- ======= Bagian Keterampilan (Skills) ======= -->
        <section id="skills" class="skills">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{ '' }}assets/user/img/skills.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                        <h3>Template Kreatif untuk Setiap Proyek yang Tersedia</h3>
                        <p class="fst-italic text-white">
                            Temukan keterampilan kreatif Anda dengan koleksi template kami yang kaya akan fitur.
                        </p>

                        <div class="skills-content">

                            @php
                                $totalItems = $tk->count();
                            @endphp

                            @if ($totalItems > 0)
                                @foreach ($tk->groupBy('id_kategori') as $data)
                                    @php
                                        $percentage = ($data->count() / $totalItems) * 100;
                                    @endphp
                                    <div class="progress">
                                        <span class="skill">{{ $data->first()->kategori->nama_kategori }} <i
                                                class="val">{{ round($percentage) }}% / 100%</i></span>
                                        <div class="progress-bar-wrap">
                                            <div class="progress-bar" role="progressbar"
                                                aria-valuenow="{{ round($percentage) }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No data available.</p>
                            @endif




                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End Bagian Keterampilan (Skills) -->
        <hr>

        <!-- ======= galery Section ======= -->
        <section id="galery" class="portfolio section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Template Code</h2>
                    <p>Kami menyediakan beragam jenis template code berkualitas tinggi untuk keperluan pengembangan
                        perangkat lunak Anda. Dengan template code kami, Anda dapat dengan mudah memulai proyek Anda dan
                        menghemat waktu serta upaya dalam proses pengembangan.</p>
                </div>

                <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach ($tk->groupBy('id_kategori') as $data)
                        <li data-filter=".filter-{{ $data->first()->kategori->nama_kategori }}">
                            {{ $data->first()->kategori->nama_kategori }}</li>
                    @endforeach

                </ul>


                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($Templates as $no => $data)
                        <div class="col-lg-4 col-md-6 portfolio-item @foreach ($data->tk as $jenis) filter-{{ $jenis->kategori->nama_kategori }} @endforeach"
                            style="max-width: 60%;">
                            <div class="portfolio-img">
                                <div class="background-img"
                                    style="background-image: url('{{ asset('storage/template-images/' . $data->gambar) }}');">
                                </div>
                                <div class="img-overlay">
                                    <img src="{{ asset('storage/template-images/' . $data->gambar) }}" class="img-fluid"
                                        alt="">
                                </div>
                            </div>
                            <div class="portfolio-info">
                                <h4>{{ $data->nama_template }}</h4>
                                <ul>
                                    <div class="row">
                                        <ul>
                                            @foreach ($data->tk as $jenis)
                                                <a href="{{ url('/kategori/' . $jenis->kategori->slug) }}">
                                                    <li class="badge bg-primary text-decoration-none">
                                                        {{ $jenis->kategori->nama_kategori }}
                                                    </li>

                                                </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </ul>
                                <a href="{{ asset('storage/template-images/' . $data->gambar) }}"
                                    data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"
                                    title="App 1">
                                    <i class="bx bx-plus"></i>
                                </a>
                                <a href="{{ '/code/' . $data->id }}" class="details-link" title="More Details">
                                    <i class="bx bx-link"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>



            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team ">
            <div class="container" data-aos="fade-up">

                <div class="section-title text-white">
                    <h2 class="">Tim Kami</h2>
                    <p>Kami adalah tim yang berdedikasi untuk memberikan solusi terbaik bagi Anda. Dengan pengalaman dan
                        keahlian kami, kami siap membantu memenuhi kebutuhan pengembangan perangkat lunak Anda. Berikut
                        adalah beberapa hal yang menjadikan kami pilihan yang tepat:</p>
                </div>


                <div class="row justify-content-center">

                    @foreach ($user->where('role', 'team') as $team)
                        <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                            <div class="member d-flex align-items-start">
                                <div class="pic"><img src="{{ $team->profile }}" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>{{ ucwords($team->name) }}</h4>
                                    <span>{{ ucwords($team->role) }}</span>
                                    <p>{{ $team->email }}</p>
                                    {{-- <div class="social">
                                        <a href=""><i class="ri-twitter-fill"></i></a>
                                        <a href=""><i class="ri-facebook-fill"></i></a>
                                        <a href=""><i class="ri-instagram-fill"></i></a>
                                        <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </section><!-- End Team Section -->


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span>Momo</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->
@endsection
