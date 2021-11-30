<?php $__env->startSection('title'); ?>
    Data Scientist | How do I become a Data Scientist?
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
            <div class="accordion accordion-flush" id="p4">
                <div class="border-bottom">
                    <h3 class="section-header" id="p4-header">
                        <div>How do I become a Data Scientist?</div>
                    </h3>
                </div>

                

                <div class="accordion-item">
                    <h2 class="accordion-header" id="p4-1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c-p4-1"
                            aria-expanded="true" aria-controls="c-p4-1">
                            <i class="far fa-check-circle pe-2" id="ds-icon4-1"></i>
                            Educational Pathway
                        </button>
                    </h2>

                    <div id="c-p4-1" class="accordion-collapse collapse show" aria-labelledby="p4-1" data-bs-parent="#p4">
                        <div class="accordion-body">
                            <div class="col-md-12">
                                <div>As data science is a relatively new field, some universities might offer it as a
                                    specialization in the Computer Science course, or even as a postgraduate
                                    program.<br><br>
                                    One way to learn data science intensively is through <b>bootcamps</b>. Many <b>data
                                        science
                                        bootcamp</b> nowadays are providing 3-6 months courses online and offline for those
                                    going to
                                    get into the tech industry or fresh graduates who have minimum experience.<br><br>
                                    It’s likely you’ll start from an entry-level position, such as a <b>data analyst or
                                        junior
                                        data scientist</b>. Once you completed all the additional training -- in data
                                    visualization,
                                    business intelligence applications or relational database management -- you will be
                                    promoted to mid- and advanced-level positions.</div>
                            </div>

                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                <button class="btn btn-info btn-sm px-3" onclick="next(1, 4)">
                                    Next <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="p4-2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#c-p4-2" aria-expanded="false" aria-controls="c-p4-2">
                            <i class="far fa-check-circle pe-2" id="ds-icon4-2"></i>
                            Skills
                        </button>
                    </h2>

                    <div id="c-p4-2" class="accordion-collapse collapse" aria-labelledby="p4-2" data-bs-parent="#p4">
                        <div class="accordion-body row" style="text-align: left;">
                            <div class="col-md-12 mb-2">
                                <h4>Programming Language :</h4>
                                <ul class="disc">
                                    <li>Java</li>
                                    <li>Python</li>
                                    <li>R</li>
                                    <li>SQL</li>
                                </ul>
                                <br>
                                <h4>Subjects:</h4>
                                <br>
                                Math, specifically in:
                                <ul class="disc">
                                    <li>Statistics</li>
                                    <li>Algebra</li>
                                    <li>Basic calculus</li>
                                </ul>
                            </div>

                            <div class="col-md-12 mb-2 mt-2">
                                <h4>Soft Skills:</h4>
                                <ul class="disc">
                                    <li>Storytelling</li>
                                    <li>Interpersonal and communication</li>
                                    <li>Good Intuition</li>
                                    <li>Understanding of ethics</li>
                                    <li>Lifelong learning mindset</li>
                                </ul>

                                <br>

                                <div>Storytelling and interpersonal skills are two important skills that data scientist need
                                    to have,
                                    as they are required to communicate insights from the processed data to the stakeholders
                                    in the
                                    business field.</div>
                            </div>
                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                <button class="btn btn-info btn-sm px-3" onclick="next(2, 4)">
                                    Next <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="p4-3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#c-p4-3" aria-expanded="false" aria-controls="c-p4-3">
                            <i class="far fa-check-circle pe-2" id="ds-icon4-3"></i>
                            Possible Majors
                        </button>
                    </h2>

                    <div id="c-p4-3" class="accordion-collapse collapse" aria-labelledby="p4-3" data-bs-parent="#p4">
                        <div class="accordion-body row" style="text-align: left;">
                            <div class="col-md-12 mb-2">
                                As an undergraduate student, you might want to consider taking majors such as:
                                <ul class="dash">
                                    <li><span>Computer Science</span></li>
                                    <li><span>Math (Pure/Applied)</span></li>
                                    <li><span>Statistics</span></li>
                                    <li><span>Acturial Science</span></li>
                                    <li><span>Business and Management</span></li>
                                </ul>
                                <div class="mt-3">
                                    Some companies might also require specific additional background, like Biomedical
                                    Engineering to work as Data Scientist in a health-tech company.
                                </div>
                            </div>
                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
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

    <script>
        $(document).ready(function() {
            // sessionStorage.clear();
            let n = $('.accordion-item').length
            for (i = 1; i <= n; i++) {
                if (sessionStorage.getItem('c-p4-' + i) == 'read') {
                    $('#ds-icon4-' + i).removeClass('far fa-check-circle')
                    $('#ds-icon4-' + i).addClass('fas fa-check-circle text-success')
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
            sessionStorage.setItem("c-p4-" + n, "read");
            if (sessionStorage.getItem('c-p4-' + n) == 'read') {
                $('#ds-icon4-' + n).removeClass('far fa-check-circle')
                $('#ds-icon4-' + n).addClass('fas fa-check-circle text-success')
            }

            let next = n + 1
            $('#c-p4-' + n).collapse('toggle');
            $('#c-p4-' + next).collapse('toggle');

            let j = $('.accordion-item').length
            let z = 0
            for (i = 0; i <= j; i++) {
                if (sessionStorage.getItem('c-p4-' + i) == 'read') {
                    z++
                }
            }

            if (z == j) {
                sessionStorage.setItem("part" + part, "done");
                if (sessionStorage.getItem('part' + part) == 'done') {
                    $('#ds-iconPart' + part).addClass('fas fa-check-circle float-end mt-1 text-success')
                    window.location = "<?php echo url('/data-scientist/case-studies'); ?>";
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/data-scientist-part/part-4.blade.php ENDPATH**/ ?>