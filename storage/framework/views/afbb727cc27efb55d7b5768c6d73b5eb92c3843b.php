<?php $__env->startSection('title'); ?>
    Data Scientist | Intro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('banner'); ?>
    <?php echo $__env->make('modules.data-scientist-part.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layout.module.sidebar-ds', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="card p-3">
            <div class="accordion accordion-flush" id="p0">
                <div class="border-bottom">
                    <h3 class="section-header" id="p0-header">
                        <div>Introduction</div>
                    </h3>
                </div>

                <div class="mt-3" id="accordions">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="p0-1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c-p0-1"
                                aria-expanded="true" aria-controls="c-p0-1">
                                <i class="far fa-check-circle pe-2" id="ds-icon0-1"></i>
                                What is Data Science?
                            </button>
                        </h2>

                        <div id="c-p0-1" class="accordion-collapse collapse show" aria-labelledby="p0-1"
                            data-bs-parent="#p0">
                            <div class="accordion-body row" style="text-align: left;">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/CCnCABJhAdU"
                                    class="col-md-12" title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                                <div class="col-md-12">
                                    <p class="pc">
                                        Data science is about looking back at historical data to spot patterns and
                                        relationships, and later
                                        using machine learning to better predict the future.
                                    </p>
                                </div>
                                <div class="accordion accordion-flush">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="p0-2">
                                            <button class="accordion-button" type="button" aria-expanded="true"
                                                aria-controls="c-p0-2">
                                                <i class="far fa-check-circle pe-2" id="ds-icon0-2"></i>
                                                Data Scientist as a career
                                            </button>
                                        </h2>

                                        <div class="accordion-collapse collapse show" aria-labelledby="p0-2"
                                            data-bs-parent="#p0">
                                            <div class="accordion-body row" style="text-align: left;">

                                                <div class="col-md-12">
                                                    <img src="<?php echo e(asset('img/yt-recommended.png')); ?>" width="100% ">

                                                    <p class="mt-3 pc">
                                                        Have you ever watched YouTube? Do you know why the recommendations
                                                        seem
                                                        to fit your
                                                        preferences?
                                                    </p>
                                                    <h5><strong>THAT’S THE WORK OF DATA SCIENTIST!</strong></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="p0-3">
                                            <button class="accordion-button" type="button" aria-expanded="true"
                                                aria-controls="c-p0-3">
                                                <i class="far fa-check-circle pe-2" id="ds-icon0-3"></i>
                                                Do you know basketball uses data science?
                                            </button>
                                        </h2>

                                        <div id="c-p0-3" class="accordion-collapse collapse show" aria-labelledby="p0-3"
                                            data-bs-parent="#p0">
                                            <div class="accordion-body">
                                                <iframe width="100%" height="315"
                                                    src="https://www.youtube.com/embed/MpLHMKTolVw" class="mx-auto d-block"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-end mt-4 pt-2">
                                        <button class="btn btn-info btn-sm px-3" onclick="next(1, 1)">
                                            Next <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="p0-4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#c-p0-4" aria-expanded="false" aria-controls="c-p0-4">
                                <i class="far fa-check-circle pe-2" id="ds-icon0-4"></i>
                                A Day in a Life of a Data Scientist
                            </button>
                        </h2>

                        <div id="c-p0-4" class="accordion-collapse collapse" aria-labelledby="p0-4" data-bs-parent="#p0">
                            <div class="accordion-body">

                                <div>
                                    <h4>Coming soon</h4>
                                </div>
                                <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                    <button class="btn btn-info btn-sm px-3" onclick="next(2, 1)">
                                        Next <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // sessionStorage.clear();
            let n = $('.accordion-item').length
            for (i = 1; i <= n; i++) {
                if (sessionStorage.getItem('intro' + i) == 'read') {
                    $('#ds-icon0-' + i).removeClass('far fa-check-circle')
                    $('#ds-icon0-' + i).addClass('fas fa-check-circle text-success')
                }
            }

            let nPart = $('.list-group-item').length
            for (i = 1; i <= nPart; i++) {
                if (sessionStorage.getItem('part' + i) == 'done') {
                    $('#ds-iconPart' + i).addClass('fas fa-check-circle float-end mt-1 text-success')
                }
            }
        });

        function next(n, part) {
            sessionStorage.setItem("intro" + n, "read");
            if (sessionStorage.getItem('intro' + n) == 'read') {
                $('#ds-icon0-' + n).removeClass('far fa-check-circle')
                $('#ds-icon0-' + n).addClass('fas fa-check-circle text-success')
            }

            let next = n + 1
            $('#c-p0-' + n).collapse('toggle');
            $('#c-p0-' + next).collapse('toggle');

            let j = $('#accordions > .accordion-item').length
            let z = 0
            for (i = 0; i <= j; i++) {
                if (sessionStorage.getItem('intro' + i) == 'read') {
                    z++
                }
            }

            if (z == j) {
                sessionStorage.setItem("part" + part, "done");
                if (sessionStorage.getItem('part' + part) == 'done') {
                    $('#ds-iconPart' + part).addClass('fas fa-check-circle float-end mt-1 text-success');
                    window.location = "<?php echo url('/data-scientist/2'); ?>";
                }
            }

        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/data-scientist-part/part-1.blade.php ENDPATH**/ ?>