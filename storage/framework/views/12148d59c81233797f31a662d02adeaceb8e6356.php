<?php $__env->startSection('title'); ?>
    Data Scientist | Reflection
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
            <div class="accordion accordion-flush" id="p6">
                <div class="border-bottom">
                    <h3 class="section-header" id="5-header">
                        <div>Reflection</div>
                    </h3>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="p6-1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c-p6-1"
                            aria-expanded="false" aria-controls="c-p6-1">
                            <i class="far fa-check-circle pe-2" id="ds-icon6-1"></i>
                            Ask yourself
                        </button>
                    </h2>

                    <div id="c-p6-1" class="accordion-collapse collapse show" aria-labelledby="p6-1" data-bs-parent="#p6">
                        <div class="accordion-body">
                            <div class="pc">
                                <label>
                                    After completing this module, do you think that you are interested in becoming a Data
                                    Scientist?
                                </label>
                                <textarea class="mt-3 form-control" rows="5"></textarea>
                                <br>
                                <label>If yes, do you have in mind what type of Data Scientist you want to be? Are you more
                                    of
                                    a
                                    generalist or a specialist?
                                </label>
                                <textarea class="mt-3 form-control" rows="5"></textarea>
                                <div class="col-md-12 text-end mt-3">
                                    <hr class="m-0 mb-2">
                                    <button class="btn btn-primary btn-sm px-3" onclick="next(1, 6)">
                                        Submit <i class="far fa-arrow-alt-circle-right ps-2"></i>
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
                if (sessionStorage.getItem('c-p6-' + i) == 'read') {
                    $('#ds-icon6-' + i).removeClass('far fa-check-circle')
                    $('#ds-icon6-' + i).addClass('fas fa-check-circle text-success')
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
            sessionStorage.setItem("c-p6-" + n, "read");
            if (sessionStorage.getItem('c-p6-' + n) == 'read') {
                $('#ds-icon6-' + n).removeClass('far fa-check-circle')
                $('#ds-icon6-' + n).addClass('fas fa-check-circle text-success')
            }

            let next = n + 1
            $('#c-p6-' + n).collapse('toggle');
            $('#c-p6-' + next).collapse('toggle');

            let j = $('.accordion-item').length
            let z = 0
            for (i = 0; i <= j; i++) {
                if (sessionStorage.getItem('c-p6-' + i) == 'read') {
                    z++
                }
            }

            if (z == j) {
                sessionStorage.setItem("part" + part, "done");
                if (sessionStorage.getItem('part' + part) == 'done') {
                    $('#ds-iconPart' + part).addClass('fas fa-check-circle float-end mt-1 text-success')
                    window.location = "<?php echo url('/data-scientist/glossary'); ?>";
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/data-scientist-part/reflection.blade.php ENDPATH**/ ?>