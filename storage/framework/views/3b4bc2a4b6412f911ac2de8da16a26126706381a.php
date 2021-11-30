<?php $__env->startSection('title'); ?>
    Digital Marketing | Pathway
<?php $__env->stopSection(); ?>

<?php $__env->startSection('banner'); ?>
    <?php echo $__env->make('modules.digital-marketing.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layout.module.sidebar-dm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="card">

            <div class="pt-3 pb-2 ps-3">
                <h3>How do I become a Digital
                    Marketing Specialist?</h3>
            </div>
            <hr class="m-1 border-2 mx-auto" width="95%">
            <div class="card-body">
                <div class="accordion my-2" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#part4-1">
                                <i class="far fa-check-circle pe-2" id="icon1"></i>
                                Educational Pathway
                            </button>
                        </h2>
                        <div id="part4-1" class="accordion-collapse show collapse">
                            <div class="accordion-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <p>
                                            If you’re interested in pursuing career in digital marketing, there are several
                                            subjects you need to put more focus on in high school:
                                        </p>
                                        <ul style="margin-left:-10px;">
                                            <li>English/Writing</li>
                                            <li>Business</li>
                                            <li>Economics</li>
                                            <li>Art</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <p>
                                            There is no single pathway to become digital
                                            marketing specialist.
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <img class="img" src="<?php echo e(asset('img/data-marketing/path0.png')); ?>" width="100%">
                                    </div>
                                    <div class="col-md-6">
                                        <img class="img" src="<?php echo e(asset('img/data-marketing/path1.png')); ?>" width="100%">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="pc">
                                            All industries require Digital Marketing, but you still have to consider the
                                            different channels you can use for specific industries
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-end mt-3">
                                        <hr class="m-0 mb-2">
                                        <button class="btn btn-info btn-sm px-3" onclick="next(1, 4)">
                                            Next <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#part4-2">
                                <i class="far fa-check-circle pe-2" id="icon2"></i>
                                Skills
                            </button>
                        </h2>
                        <div id="part4-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12 mb-3">
                                        <b>Art</b> <br>
                                        Basic design understanding will help Digital Marketing Specialist decide if
                                        the design already align with the branding or not
                                        <br><br>
                                        <b>Writing</b> <br>
                                        Writing class helps promote creative exploration and writing skills that are
                                        crucial for marketing. Having an established base of good vocabulary and
                                        context is essential when writing up advertisements.
                                        <br><br>
                                        <b>Time management</b> <br>
                                        It is important to know how to manage a schedule during a marketing
                                        campaign. This will help you create an efficient timeline that works for a
                                        digital marketing campaign.
                                        <br><br>
                                        <b>Analytical skills</b> <br>
                                        Analytical skills is important because it lets you become aware of moving
                                        trends and let you adapt to the mistakes of your previous campaign
                                        <br><br>
                                        <b>Multitasking</b> <br>
                                        Digital Marketing is often not a one project thing. Many campaigns and
                                        small projects might be going on at the same time. It is important for you to
                                        understand which tasks to prioritize and what tasks you can do
                                        simultaneously.

                                    </div>
                                    <div class="col-md-12 text-end">
                                        <hr class="m-0 mb-2">
                                        <button class="btn btn-info btn-sm px-3" onclick="next(2, 4)">
                                            Next <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#part4-3">
                                <i class="far fa-check-circle pe-2" id="icon3"></i>
                                Possible Majors
                            </button>
                        </h2>
                        <div id="part4-3" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12 mb-3">
                                        The good news is that there are quite a few options of majors if you want to be a
                                        Digital Marketing Specialist. Here are a few:
                                        <ul class="my-3">
                                            <li>Marketing</li>
                                            <li>Advertising</li>
                                            <li>Communications</li>
                                            <li>Journalism</li>
                                            <li>Graphic design</li>
                                            <li>System Informatics</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 text-end">
                                        <hr class="m-0 mb-2">
                                        <button class="btn btn-info btn-sm px-3" onclick="next(3, 4)">
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
    </div>

    <script>
        $(document).ready(function() {
            // sessionStorage.clear();
            let n = $('.accordion-item').length
            for (i = 1; i <= n; i++) {
                if (sessionStorage.getItem('part4-' + i) == 'read') {
                    $('#icon' + i).removeClass('far fa-check-circle')
                    $('#icon' + i).addClass('fas fa-check-circle text-success')
                }
            }

            let nPart = $('.list-group-item').length
            for (i = 1; i <= nPart; i++) {
                if (sessionStorage.getItem('dm-part' + i) == 'done') {
                    $('#dm-iconPart' + i).addClass('fas fa-check-circle text-success float-end mt-1')
                }
            }
        });

        function next(n, part) {
            sessionStorage.setItem("part" + part + "-" + n, "read");
            if (sessionStorage.getItem("part" + part + "-" + n) == 'read') {
                $('#icon' + n).removeClass('far fa-check-circle')
                $('#icon' + n).addClass('fas fa-check-circle text-success')
            }

            let next = n + 1
            $('#part' + part + '-' + n).collapse('toggle');
            $('#part' + part + '-' + next).collapse('toggle');

            let j = $('.accordion-item').length
            let z = 0
            for (i = 0; i <= j; i++) {
                if (sessionStorage.getItem('part' + part + '-' + i) == 'read') {
                    z++
                }
            }

            let nextPart = part + 1
            if (z == j) {
                sessionStorage.setItem("dm-part" + part, "done");
                if (sessionStorage.getItem('dm-part' + part) == 'done') {
                    $('#dm-iconPart' + part).addClass('fas fa-check-circle text-success float-end mt-1')
                    window.location.href = "<?php echo e(url('digital-marketing/part-')); ?>" + nextPart;
                }
            }

        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/digital-marketing/part-4.blade.php ENDPATH**/ ?>