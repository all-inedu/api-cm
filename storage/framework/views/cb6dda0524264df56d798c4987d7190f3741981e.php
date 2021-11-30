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
    <title>Data Scientist 101</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <script src="<?php echo e(asset('js/jquery-3.6.0.js')); ?>"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light blue">
        <div class="container">
            <a class="navbar-brand text-white" href="#">
                <img src="<?php echo e(asset('img/allin.png')); ?>" width="20%">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarText" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto my-5 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px; white-space: nowrap;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Career Module</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid m-0 p-0">
        <div class="card">
            <div class="card-body text-center banner" style="text-align: right !important;">
                <div class="container" style="height:100%;">
                    <div class="mt-5 pt-4">
                        <h1 style="font-weight:bold">Data Science<br>101</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        In this module, you will learn about what Data Scientist do, types of it, and how you could be a Data Scientist. Along with case studies, and reflection, we hope that you can gain a deeper knowledge on Data Scientist and how to implement them in real-life events. <br><br>Happy learning!
    </div>

    <div class="container mt-3">
        <div class="row">
            <!-- Sidebar  -->
            <div class="col-md-3">
                <div id="sidebar">
                    <?php echo $__env->make('modules.data-scientist-part.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>

            <!-- Content  -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div id="main-container">
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-2">
                    <img src="<?php echo e(url('img/logo.png')); ?>" width="125px" alt="">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-6">
                    Copyright © 2021 ALL-in Eduspace All rights reserved
                </div>
                <div class="col-6 text-end">
                    <div class="d-inline-flex flex-row social-media">
                        <p>Follow Us</p>
                        <div class="ms-3"><i class="fab fa-instagram"></i></div>
                        <div class="ms-2"><i class="fab fa-youtube"></i></div>
                        <div class="ms-2"><i class="fab fa-linkedin"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
        integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/"
        crossorigin="anonymous"></script> -->
</body>

</html><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/data-scientist-part/app.blade.php ENDPATH**/ ?>