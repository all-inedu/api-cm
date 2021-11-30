<?php $__env->startSection('title'); ?>
    Home
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container pt-5">
        <div class="w-8/12 mr-auto ml-auto">
            <div class="row mt-4 items-center">
                <div class="col text-center">
                    <p class="text-xl font-semibold text-darkblue">
                        We are an independent university consultant based in Jakarta, Indonesia.
                        Our mission is to ensure that students are thriving into the path they aspire to have in the
                        future.<br>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <img src="<?php echo e(asset('img/Icon_1.png')); ?>" class="mr-auto ml-auto"><br>
                    <span>100% Students placed<br>at target universities</span>
                </div>
                <div class="col text-center">
                    <img src="<?php echo e(asset('img/Icon_2.png')); ?>" class="mr-auto ml-auto"><br>
                    <span>More than 40<br>School Clients</span>
                </div>
                <div class="col text-center">
                    <img src="<?php echo e(asset('img/Icon_3.png')); ?>" class="mr-auto ml-auto"><br>
                    <span>More than 1,000<br>Esays Reviewed</span>
                </div>
            </div>
            <div class="row mt-md-4">
                <div class="col text-center">
                    <img src="<?php echo e(asset('img/Icon_4.png')); ?>" class="mr-auto ml-auto"><br>
                    <span>More than 50<br>Corporate Partners</span>
                </div>
                <div class="col text-center">
                    <img src="<?php echo e(asset('img/Icon_5.png')); ?>" class="mr-auto ml-auto"><br>
                    <span>150+ Point SAT<br>Score Improvement</span>
                </div>
                <div class="col text-center">
                    <img src="<?php echo e(asset('img/Icon_6.png')); ?>" class="mr-auto ml-auto"><br>
                    <span>More than 1,500<br>Event Participants</span>
                </div>
            </div>
            <br><br>

            <div class="text-center mt-4">
                <a href="https://all-inedu.com/about">
                    <button class="btn btn-allin text-white py-2 px-4 font-bold">Find Out More</button>
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/about-us.blade.php ENDPATH**/ ?>