<?php $__env->startSection('title'); ?>
    Data Scientist | Other Resources
<?php $__env->stopSection(); ?>

<?php $__env->startSection('banner'); ?>
    <div class="banner">
        <div class="container">
            <h1 class="title">
                Data Science <br>
                101
            </h1>
        </div>
    </div>
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
                        <li><a href="https://www.coursera.org/learn/sql-data-science?specialization=introduction-data-science">Databases
                                and SQL for Data Science with Python</a></li>
                        <li><a href="https://www.coursera.org/learn/data-cleaning">Getting and Cleaning Data</a></li>
                        <li><a href="https://www.coursera.org/learn/data-visualization-tableau?specialization=data-visualization">Fundamentals
                                of Visualization with Tableau</a></li>
                        <li><a href="https://www.edx.org/course/data-science-method">The Data Science Method</a></li>
                        <li><a href="https://www.edx.org/course/foundations-of-data-science-prediction-and-machine">Data Science:
                                Machine Learning and Predictions</a></li>
                        <li><a
                                href="https://www.analyticsvidhya.com/blog/2018/11/data-engineer-comprehensive-list-resources-get-started/">Data
                                Engineering</a></li>
                        <li><a href="https://www.datapine.com/blog/data-analysis-methods-and-techniques/">Data Analysis</a></li>
                        <li><a href="https://www.futurelearn.com/info/blog/what-is-machine-learning-a-beginners-guide">Machine
                                Learning</a></li>
                    </ul>
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
            sessionStorage.setItem("c-p6-" + n, "read");
            if (sessionStorage.getItem('c-p6-' + n) == 'read') {
                $('#icon6-' + n).removeClass('far fa-check-circle')
                $('#icon6-' + n).addClass('fas fa-check-circle text-success')
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

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/career-module/resources/views/modules/data-scientist-part/other.blade.php ENDPATH**/ ?>