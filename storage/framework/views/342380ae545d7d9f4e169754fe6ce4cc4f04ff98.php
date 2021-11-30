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
    <link rel="stylesheet" href="http://codylindley.com/thickbox/thickbox-code/thickbox.css">
    <script src="<?php echo e(asset('js/jquery-3.6.0.js')); ?>"></script>
    <script src="<?php echo e(asset('js/thickbox.js')); ?>"></script>
</head>

<body>
    <section class="body"></section>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f7f7f7;">
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

    <div class="container-fluid p-0" style="margin-bottom: 10%; ">
        <?php echo $__env->yieldContent('content'); ?>
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
                    <a href="<?php echo e(asset('file/CAREER  EXPLORATION  GUIDELINES.pdf')); ?>" id="download-guidebook" target="_blank"
                        class="btn btn-primary">Download the GUIDEBOOK</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script>
        // sessionStorage.clear();

        $("#download-guidebook").click(function(e) {
            e.preventDefault();
            if (!sessionStorage.getItem('download-guidebook')) {
                let url = $(this).attr('href');
                window.open(url);
                sessionStorage.setItem('download-guidebook', true);
                location.reload();
            }
        });

        if (sessionStorage.getItem('download-guidebook')) {
            $("#reflection-btn").show();
        }


        if (sessionStorage.getItem('digital-marketing')) {
            $('#dm').removeClass('d-none')
        }

        if (sessionStorage.getItem('data-science')) {
            $('#ds').removeClass('d-none')
        }

        $("#start-your-journey-btn").click(function() {
            $('#guideline').modal('show')
        })

        $("#reflection-btn").click(function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            window.open(url);
        })

    </script>
    <style>
        img {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* img:hover {
            opacity: 0.7;
        } */

        #image-viewer {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .modal-content {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes  zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        #image-viewer .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        #image-viewer .close:hover,
        #image-viewer .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        @media  only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }

        .sp {
            position: relative;
            padding-bottom: 1em;
            margin-bottom: 2em;
            font-size: 23px;
        }

        .sp::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 5px;
            bottom: 0;
            background-color: #584aa8;
            left: 0;
            margin-left: 41.5%;
        }

        label {
            font-style: italic;
            font-weight: 500;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous">
    </script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"-->
    <!--    integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">-->
    <!--</script>-->
</body>

</html>
<?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/layout/app.blade.php ENDPATH**/ ?>