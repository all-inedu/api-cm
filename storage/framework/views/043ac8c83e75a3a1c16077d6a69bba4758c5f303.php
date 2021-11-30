
<?php $__env->startSection('title'); ?>
    Home
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <br>
    <div class="container position-relative">
        <h1 class="float-end title-banner">
            Welcome To <br>
            Career Exploration <br> Module
        </h1>
        <img src="<?php echo e(asset('img/CMW_Career module cover.webp')); ?>" width="100%" class="shadow">
    </div>

    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <div class="text-center my-5 px-5">
                    <p style="font-size: 24px;" class="fst-italic">
                        Are you currently trying to figure out what you want as a career in the future?
                    </p>
                    <p style="font-size: 20px">
                        Career Exploration Module is here to provide you the space to discover various job roles and
                        industries of
                        your
                        interest. Learn the basic knowledge of each career and how to implement them through
                        hands-on
                        learning
                        experience here.<br><br>
                        <b>Let’s walk on your career exploration journey with Career Exploration Module!</b>
                    </p>
                </div>

                <div class="text-center">
                    <a href="javascript:void(0)" class="text-decoration-none" id="start-your-journey-btn">
                        <button class="btn btn-allin">Start Your Journey</button>
                    </a>

                    <a href="<?php echo e(asset('file/Initial Reflection.xlsx')); ?>" class="text-decoration-none" id="reflection-btn">
                        <button class="btn btn-allin-blue">Reflection</button>
                    </a>
                </div>

                <br><br>
            </div>
        </div>

        <div class="card border border-3">
            <div class="card-body p-md-5 pt-0">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="text-start">
                            <h3 id="career"><i class="far fa-hand-pointer pe-3"
                                    style="transform:rotate(180deg)"></i>&nbsp;&nbsp;<b>Career Choices</b></h3>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-md-5">
                    <div class="col mb-2">
                        <a href="<?php echo e(url('digital-marketing/part-1')); ?>">
                            <div class="card border-allin">
                                <div class="container2 img-bg">
                                    <img src="<?php echo e(asset('img/icon/CMW_1. Digital Marketing.webp')); ?>"
                                        class="card-img-top">
                                    <div class="bottom-right">Digital Marketing <br>Specialist</div>
                                    <i class="fas fa-check-circle text-success float-end mt-1 d-none icon-done" id="dm"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col mb-2">
                        <a href="<?php echo e(url('data-scientist/1')); ?>">
                            <div class="card border-allin">
                                <div class="container2 img-bg">
                                    <img src="<?php echo e(asset('img/icon/CMW_2. Data Scientist.webp')); ?>" class="card-img-top">
                                    <div class="bottom-right">Data Scientist</div>
                                    <i class="fas fa-check-circle text-success float-end mt-1 d-none icon-done" id="ds"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-allin">
                            <div class="container-overflow text-center pt-2">
                                
                            </div>
                            <div class="container2 img-bg">
                                <img src="<?php echo e(asset('img/icon/CMW_3. Full Stack Engineer.webp')); ?>"
                                    class="card-img-top blur">
                                <div class="bottom-right blur">Full Stack Engineering</div>

                                <i class="fas fa-lock text-dark mt-1 float-start icon-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-allin">
                            <div class="container-overflow text-center pt-2">
                                
                            </div>
                            <div class="container2 img-bg">
                                <img src="<?php echo e(asset('img/icon/CMW_4. UX Designer.webp')); ?>" class="card-img-top blur">
                                <div class="bottom-right blur">UX Designer</div>

                                <i class="fas fa-lock text-dark mt-1 float-start icon-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-allin">
                            <div class="container-overflow text-center pt-2">
                                
                            </div>
                            <div class="container2 img-bg">
                                <img src="<?php echo e(asset('img/icon/CMW_5.Biomedical Engineer.webp')); ?>"
                                    class="card-img-top blur">
                                <div class="bottom-right blur">Biomedical Engineering</div>

                                <i class="fas fa-lock text-dark mt-1 float-start icon-lock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <div class="card border-allin">
                            <div class="container-overflow text-center pt-2">
                                
                            </div>
                            <div class="container2 img-bg">
                                <img src="<?php echo e(asset('img/icon/CMW_6.Investment Analyst.webp')); ?>"
                                    class="card-img-top blur">
                                <div class="bottom-right blur">Investment Analyst</div>

                                <i class="fas fa-lock text-dark mt-1 float-start icon-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-allin">
                            <div class="container-overflow text-center pt-2">
                                
                            </div>
                            <div class="container2 img-bg">
                                <img src="<?php echo e(asset('img/icon/CMW_7. Psychologist.webp')); ?>" class="card-img-top blur">
                                <div class="bottom-right blur">Psychologist</div>

                                <i class="fas fa-lock text-dark mt-1 float-start icon-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-allin">
                            <div class="container-overflow text-center pt-2">
                                
                            </div>
                            <div class="container2 img-bg">
                                <img src="<?php echo e(asset('img/icon/CMW_8. Conten Creator.webp')); ?>" class="card-img-top blur">
                                <div class="bottom-right blur">Content Creator</div>

                                <i class="fas fa-lock text-dark mt-1 float-start icon-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-allin">
                            <div class="container-overflow text-center pt-2">
                                
                            </div>
                            <div class="container2 img-bg">
                                <img src="<?php echo e(asset('img/icon/CMW_9. Food Scientist.webp')); ?>" class="card-img-top blur">
                                <div class="bottom-right blur">Food Scientist</div>

                                <i class="fas fa-lock text-dark mt-1 float-start icon-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="card border-allin">
                            <div class="container-overflow text-center pt-2">
                                
                            </div>
                            <div class="container2 img-bg">
                                <img src="<?php echo e(asset('img/icon/CMW_10. Medical Doctor.webp')); ?>" class="card-img-top blur">
                                <div class="bottom-right blur">Medical Doctor</div>

                                <i class="fas fa-lock text-dark mt-1 float-start icon-lock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $('.img-bg').each(function() {
            $(this).click(function(e) {
                sessionStorage.setItem('first', 'clicked')
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\career-module\resources\views/index.blade.php ENDPATH**/ ?>