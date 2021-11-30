<?php $__env->startSection('title'); ?>
    Data Scientist | Other Resources
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
            <div class="accordion accordion-flush" id="p7">
                <div class="accordion-item">
                    <h3 class="section-header" id="p7-header">
                        <div>Additional Resources</div>
                    </h3>
                </div>

                <div class="pt-4">
                    <ul class="ul-spacing">
                        <li><a
                                href="https://www.coursera.org/learn/open-source-tools-for-data-science?specialization=introduction-data-science">Tools
                                for Data Science</a></li>
                        <li><a
                                href="https://www.coursera.org/learn/data-science-methodology?specialization=introduction-data-science">Data
                                Science Methodology</a></li>
                        <li><a
                                href="https://www.coursera.org/learn/sql-data-science?specialization=introduction-data-science">Databases
                                and SQL for Data Science with Python</a></li>
                        <li><a href="https://www.coursera.org/learn/data-cleaning">Getting and Cleaning Data</a></li>
                        <li><a
                                href="https://www.coursera.org/learn/data-visualization-tableau?specialization=data-visualization">Fundamentals
                                of Visualization with Tableau</a></li>
                        <li><a href="https://www.edx.org/course/data-science-method">The Data Science Method</a></li>
                        <li><a href="https://www.edx.org/course/foundations-of-data-science-prediction-and-machine">Data
                                Science:
                                Machine Learning and Predictions</a></li>
                        <li><a
                                href="https://www.analyticsvidhya.com/blog/2018/11/data-engineer-comprehensive-list-resources-get-started/">Data
                                Engineering</a></li>
                        <li><a href="https://www.datapine.com/blog/data-analysis-methods-and-techniques/">Data Analysis</a>
                        </li>
                        <li><a href="https://www.futurelearn.com/info/blog/what-is-machine-learning-a-beginners-guide">Machine
                                Learning</a></li>
                    </ul>
                </div>
                <div class="col-md-12 text-end mt-4 pt-2 border-top">
                    <button class="btn btn-success btn-sm px-3" onclick="next(1, 8)">
                        Finish <i class="fas fa-check-circle ps-3"></i>
                    </button>
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
                    $('#icon6-' + i).removeClass('far fa-check-circle')
                    $('#icon6-' + i).addClass('fas fa-check-circle text-success')
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
            sessionStorage.setItem("part" + part, "done");
            // sessionStorage.setItem('digital-marketing', 'done')

            let j = $('.list-group-item').length
            let z = 0
            for (i = 1; i <= j; i++) {
                if (sessionStorage.getItem('part' + i) == 'done') {
                    console.log(i)
                    z++
                }
            }

            if (j == z) {
                Swal.fire({
                    title: 'Congratulation',
                    text: "You have completed this module",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        sessionStorage.setItem('data-science', 'done')
                        window.location.href = "<?php echo e(url('')); ?>"
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please complete all parts of this module first!'
                })
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/data-scientist-part/other.blade.php ENDPATH**/ ?>