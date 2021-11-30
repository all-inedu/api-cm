<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="<?php echo e(url('img/icon.ico')); ?>" type="image/x-icon">
    <title>
        Career Module - <?php echo $__env->yieldContent('title'); ?>
    </title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style-module.css')); ?>">
    <script src="<?php echo e(asset('js/jquery-3.6.0.js')); ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo $__env->yieldContent('style'); ?>
</head>

<body>
    <div class="body"></div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: #f7f7f7;">
        <div class="container my-1">
                        <img src="<?php echo e(asset('img/logo-1.png')); ?>" width="16%" class="navbar-brand" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav me-auto mb-2 mb-lg-0">
                </div>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo e(url('')); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(asset('file/CAREER  EXPLORATION  GUIDELINES.pdf')); ?>"
                                target="_blank">Guideline Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(url('/about-us')); ?>">About Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <div class="container  mb-4" style="margin-top: 2%">
        <div class="row">
            <div class="col-md-12" style="padding-top:5%;">
                <?php echo $__env->yieldContent('banner'); ?>
            </div>
            <div class="col-md-3">
                <div class="sticky-top" style="top:12%; ">
                    <?php echo $__env->yieldContent('sidebar'); ?>
                </div>
            </div>
            <div class="col-md-9">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 pt-4">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="<?php echo e(url('img/logo.png')); ?>" width="125px" alt="">
                </div>
                <div class="col-md-3 mb-3">
                    <i class="fas fa-globe fa-fw"></i> <a href="https://all-inedu.com"
                        target="_blank">www.all-inedu.com</a>
                    <br>
                    <i class="fab fa-instagram fa-fw"></i> <a href="https://www.instagram.com/allineduspace/"
                        target="_blank">@allineduspace</a>
                </div>
                <div class="col-md-5 mb-3 ps-md-5">
                    <i class="fas fa-mobile-alt fa-fw"></i> <a href="https://wa.me/6281808081363" target="_blank">+62
                        818-0808-1363</a> /
                    <a href="https://wa.me/6287860811413" target="_blank">+62 878-6081-1413</a> <br>
                    <i class="fas fa-envelope fa-fw"></i> <a href="mailto:info@all-inedu.com"
                        target="_blank">info@all-inedu.com</a>
                </div>
                <div class="col-md-12">
                    <hr class="my-2">
                </div>
                <div class="col-md-4 mb-3">
                    Jl Jeruk Kembar Blok Q9, No. 15 <br> Srengseng, Kembangan <br>
                    Jakarta Barat 11630, Indonesia
                </div>
                <div class="col-md-3 mb-3">
                    #itsALLintheprep <br>
                    #TakeOnYourFuture
                </div>
                <div class="col-md-5 mb-3 ps-md-5">
                    Copyright © 2021 · ALL-in Eduspace. <br>
                    All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <div class="modal  fade" id="imagemodal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content text-white" style="background: #272727ee">
                <div class="modal-header">
                    <small class="modal-title">Image Preview</small>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-auto py-5">
                    <img src="" id="imagepreview">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="guideline">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Guideline Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: justify;">
                    Before starting your career exploration journey, make sure to read our CAREER EXPLORATION
                    GUIDEBOOK
                    <ul class=" mt-2" style="margin-left:-10px;">
                        <li>
                            Career Roadmap
                        </li>
                        <li>
                            Understanding breadth, depth, and choosing university major
                        </li>
                    </ul>
                </div>
                <div class="modal-footer mx-auto">
                    <a href="<?php echo e(asset('file/CAREER  EXPLORATION  GUIDELINES.pdf')); ?>" target="_blank"
                        class="btn btn-primary">Download the GUIDEBOOK</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            // sessionStorage.clear();
            $('.img').each(function() {
                $(this).click(function() {
                    $('#imagemodal').modal('show')
                    $('#imagepreview').attr('src', $(this).attr('src'));
                })
            })

            if (sessionStorage.getItem('first') == 'clicked') {
                if (!sessionStorage.getItem('guideline')) {
                    $('#guideline').modal('show')
                }
                sessionStorage.setItem('guideline', 'showed')
            }
        })

        $('.list-group-item').each(function() {
            $(this).click(function() {
                let href = $(this).find('a').attr('href')
                window.location.href = href;
            })
        })

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous">
    </script>
    
</body>

</html>
<?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/layout/module/app.blade.php ENDPATH**/ ?>