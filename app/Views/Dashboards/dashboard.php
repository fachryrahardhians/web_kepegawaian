<?= $this->extend('layouts/dashboard/dashboard') ?>
<?= $this->section('header') ?>
<style>
    .hero-carousel {
        height: 40vh;
        /* 40% tinggi layar */
        min-height: 220px;
        max-height: 450px;
    }

    .hero-carousel .carousel-item {
        height: 100%;
    }

    .hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card {
        overflow: hidden;
        margin: 8px;

    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div id="carouselExample" class="carousel slide col-md-12" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner hero-carousel">
                <div class="carousel-item active">
                    <img class="d-block hero-img" src="https://png.pngtree.com/thumb_back/fh260/background/20240726/pngtree-the-hydroelectric-power-plant-near-the-large-earth-dam-in-the-image_15927268.jpg" alt="First slide" />
                    <!-- <div class="carousel-caption d-none d-md-block">
                        <h3>First slide</h3>
                        <p>Eos mutat malis maluisset et, agam ancillae quo te, in vim congue pertinacia.</p>
                    </div> -->
                </div>
                <div class="carousel-item">
                    <img class="d-block hero-img" src="https://bptsugm.com/wp-content/uploads/2017/10/bendung.jpg" alt="Second slide" />
                    <!-- <div class="carousel-caption d-none d-md-block">
                        <h3>Second slide</h3>
                        <p>In numquam omittam sea.</p>
                    </div> -->
                </div>
                <div class="carousel-item">
                    <img class="d-block hero-img" src="https://png.pngtree.com/thumb_back/fh260/background/20240726/pngtree-the-hydroelectric-power-plant-near-the-large-earth-dam-in-the-image_15927268.jpg" alt="Third slide" />
                    <!-- <div class="carousel-caption d-none d-md-block">
                        <h3>Third slide</h3>
                        <p>Lorem ipsum dolor sit amet, virtute consequat ea qui, minim graeco mel no.</p>
                    </div> -->
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <span class="badge badge-center bg-label-success"><i class='icon-base bx bx-user'></i></span>
                        <div class="dropdown"><button aria-label="Click me" class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3"><a aria-label="view more" class="dropdown-item" href="#">View More</a><a aria-label="delete" class="dropdown-item" href="#">Delete</a></div>
                        </div>
                    </div><span class="fw-medium d-block mb-1">Jumlah Pegawai</span>
                    <h3 class="card-title mb-2">$12,628</h3><small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <span class="badge badge-center bg-label-success"><i class='icon-base bx bx-community'></i></span>
                        <div class="dropdown"><button aria-label="Click me" class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3"><a aria-label="view more" class="dropdown-item" href="#">View More</a><a aria-label="delete" class="dropdown-item" href="#">Delete</a></div>
                        </div>
                    </div><span class="fw-medium d-block mb-1">Profit</span>
                    <h3 class="card-title mb-2">$12,628</h3><small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <span class="badge badge-center bg-label-success"><i class='icon-base bx bx-community'></i></span>
                        <div class="dropdown"><button aria-label="Click me" class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3"><a aria-label="view more" class="dropdown-item" href="#">View More</a><a aria-label="delete" class="dropdown-item" href="#">Delete</a></div>
                        </div>
                    </div><span class="fw-medium d-block mb-1">Profit</span>
                    <h3 class="card-title mb-2">$12,628</h3><small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <span class="badge badge-center bg-label-success"><i class='icon-base bx bx-community'></i></span>
                        <div class="dropdown"><button aria-label="Click me" class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3"><a aria-label="view more" class="dropdown-item" href="#">View More</a><a aria-label="delete" class="dropdown-item" href="#">Delete</a></div>
                        </div>
                    </div><span class="fw-medium d-block mb-1">Profit</span>
                    <h3 class="card-title mb-2">$12,628</h3><small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>