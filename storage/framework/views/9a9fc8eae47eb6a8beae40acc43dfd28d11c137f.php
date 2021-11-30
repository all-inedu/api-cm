<?php $__env->startSection('title'); ?>
    Data Scientist | What does a Data Scientist do?
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
            <div class="accordion accordion-flush" id="p3">
                <div class="border-bottom">
                    <h3 class="section-header" id="p3-header">
                        <div>What does a Data Scientist do?</div>
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5 class="my-0 p-0">Core Tasks</h5>
                            <hr class="my-0 p-0 mb-3">

                            <div class="p-0">
                                <p class="font-cst">
                                    A data scientist’s job generally covers the whole process of data science, which
                                    includes:
                                </p>
                            </div>
                            <ul class="ul-cst">
                                <li>
                                    <span><b>Business Understanding :</b> determining the business aim of the data.</span>
                                </li>
                                <li>
                                    <span><b>Data Understanding :</b> having a deep understanding about the dataset
                                        used.</span>
                                </li>
                                <li>
                                    <span><b>Data Preparation :</b> Initial process of cleaning and transforming data for
                                        the
                                        modeling process.</span>
                                </li>
                                <li><span><b>Modelling :</b> Producing a set of rules that is required to predict or analyse
                                        with
                                        the dataset.</span></li>

                                <li><span><b>Evaluation :</b> Monitoring the performance of model built.</span></li>
                                <li><span><b>Deployment :</b> Applying the model to the system for business as usual
                                        purposes.</span></li>
                            </ul>
                            <figure class="my-3">
                                <img src="<?php echo e(asset('img/what-do-datascientists-do.png')); ?>"
                                    class="rounded mx-auto d-block">
                            </figure>

                        </div>
                    </div>

                    <div class="row mt-3 lh-lg">
                        <div class="col-md-12">
                            <h5 class="my-0 p-0">Data Scientist as a career</h5>
                            <hr class="my-0 p-0 mb-3">

                            <ul class="ul-cst">
                                <li><span><b>Data Scientist</b> is a rising career nowadays as the demand for data science
                                        professionals is very high but the supply is very low.</span></li>
                                <li><span>The <b>high demand</b> is due to the growing popularity of <b>data-driven
                                            decision</b>
                                        making in many companies. The U.S. Bureau of Labor Statistics sees strong growth in
                                        the data science field and predicts the number of jobs will increase by <b>about
                                            28%</b>
                                        through 2026.</span>
                                </li>
                                <li><span>Whereas the <b>low supply</b> is because data science is still relatively a
                                        <b>new</b>
                                        field and
                                        there are only few educational programs available for aspiring data scientists.
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <figure class="col-md-12 pt-3 pb-3">
                            <img src="<?php echo e(asset('img/harvard-business-review.png')); ?>" class="rounded mx-auto d-block">
                        </figure>
                        <div class="col-md-12">
                            <div class="pc">
                                According to Harvard Business Review, Data Scientist is the sexiest job of
                                the 21st
                                century. What do you think is the reason?
                                <textarea rows="5" class="form-control rounded mx-auto d-block mt-2"></textarea>

                                <div class="text-end mt-2">
                                    <a href="#data-centric">
                                        <button type="button" class="btn btn-primary">Submit</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>

                    <div class="row mt-3" id="data-centric">
                        <div class="col-md-12">
                            <h5 class="m-0 p-0">Data Scientist for business</h5>
                            <hr class="my-0 p-0 mb-3">

                            <div class="mb-3">As we live in a data-centric world, data science is applied in :
                            </div>
                            <ul class="ul-cst">
                                <li><span>Healthcare</span></li>
                                <li><span>Manufacturing</span></li>
                                <li><span>Marketing</span></li>
                                <li><span>Finance</span></li>
                                <li><span>Technologies (e.g Augmented Reality or Speech Recognition)</span></li>
                            </ul>
                            <figure class="mt-3">
                                <img src="<?php echo e(asset('img/data-science-business.png')); ?>" class="rounded mx-auto d-block">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-4">

            </div>

            <div class="m-4 pc">
                <h6 style="font-size: 1em !important">What does a data scientist do?</h6>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio1" id="option1">
                    <label class="form-check-label" for="option1">
                        Transforming data into a format that can be easily analyzed
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio1" id="option2">
                    <label class="form-check-label" for="option2">
                        Interpreting data, analyzing results using statistical techniques
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio1" id="option3">
                    <label class="form-check-label" for="option3">
                        Using machine learning to create predictive models
                    </label>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary btn-sm px-3 mt-2" onclick="next(1, 3)">
                        Submit <i class="far fa-arrow-alt-circle-right ps-2"></i>
                    </button>
                </div>
            </div>


            

            

            <!-- dihapus -->
            

            <!-- dihapus -->
            

            

            
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            // sessionStorage.clear();
            let n = $('.accordion-item').length
            for (i = 1; i <= n; i++) {
                if (sessionStorage.getItem('c-p3-' + i) == 'read') {
                    $('#ds-icon3-' + i).removeClass('far fa-check-circle')
                    $('#ds-icon3-' + i).addClass('fas fa-check-circle text-success')
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
            sessionStorage.setItem("c-p3-" + n, "read");
            if (sessionStorage.getItem('c-p3-' + n) == 'read') {
                $('#ds-icon3-' + n).removeClass('far fa-check-circle')
                $('#ds-icon3-' + n).addClass('fas fa-check-circle text-success')
            }

            let next = n + 1
            $('#c-p3-' + n).collapse('toggle');
            $('#c-p3-' + next).collapse('toggle');

            let j = $('.accordion-item').length
            let z = 0
            for (i = 0; i <= j; i++) {
                if (sessionStorage.getItem('c-p3-' + i) == 'read') {
                    z++
                }
            }

            if (z == j) {
                sessionStorage.setItem("part" + part, "done");
                if (sessionStorage.getItem('part' + part) == 'done') {
                    $('#ds-iconPart' + part).addClass('fas fa-check-circle float-end mt-1 text-success')
                    window.location = "<?php echo url('/data-scientist/3'); ?>";
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/data-scientist-part/part-2.blade.php ENDPATH**/ ?>