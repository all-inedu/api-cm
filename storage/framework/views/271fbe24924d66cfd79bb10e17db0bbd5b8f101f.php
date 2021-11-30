<?php $__env->startSection('title'); ?>
    Data Scientist | Case Studies
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
            <div class="accordion accordion-flush" id="p5">
                <div class="border-bottom">
                    <h3 class="section-header" id="p5-header">
                        <div>Case Study</div>
                    </h3>
                </div>

                

                <div class="accordion-item accordion-parent">
                    <h2 class="accordion-header" id="p5-1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c-p5-1"
                            aria-expanded="true" aria-controls="c-p5-1">
                            <i class="far fa-check-circle pe-2" id="ds-icon5-1"></i>
                            Case Study #1
                        </button>
                    </h2>

                    <div id="c-p5-1" class="accordion-collapse collapse show" aria-labelledby="p5-2" data-bs-parent="#p5">
                        <div class="accordion-body" style="text-align: left;">
                            <div class="pc">
                                <p>Data Science plays a huge role in many industries. One of the industry that are also
                                    affected
                                    by data
                                    science is retail sector. Majority of the leading retail stores implement Data Science
                                    to
                                    keep track
                                    of their customer needs and make better business decisions. As a data scientist, you
                                    will be
                                    asked
                                    to give a better understanding to the retailers on their current sales condition.
                                    Provide a
                                    step by
                                    step explanation of how the raw data will turn into visualization for a better
                                    understanding.</p>
                                <div class="text-center mb-4">
                                    <a href="<?php echo e(asset('file/Retail Dataset Worksheet.xlsx')); ?>">
                                        <button class="btn btn-primary btn-sm px-3">Download the Dataset</button>
                                    </a>
                                </div>

                                

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-allin collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#c-p5-1-1" aria-expanded="false"
                                            aria-controls="c-p5-1-1">
                                            <i class="far fa-check-circle pe-2" id="ds-icon5-1-1"></i>
                                            Understand the Data
                                        </button>
                                    </h2>
                                    <div id="c-p5-1-1" class="accordion-collapse collapse">
                                        <div class="accordion-body">

                                            <div>Try to understand the data letter by answering these questions:</div>

                                            <hr>
                                            <div>Check how many:</div>

                                            <div class="sub-border">
                                                <div class="pt-3 pb-3 ms-4">
                                                    <h6 class="fw-normal">Columns and rows in the data?</h6>
                                                    
                                                    <textarea class="form-control w-100" id="" cols="30"
                                                        rows="5"></textarea>
                                                </div>

                                                <div class="pt-3 pb-3 ms-4">
                                                    <h6 class="fw-normal">Distinct stores in the data?</h6>
                                                    
                                                    <textarea class="form-control w-100" id="" cols="30"
                                                        rows="5"></textarea>
                                                </div>

                                                <div class="pt-3 pb-3 ms-4">
                                                    <h6 class="fw-normal">Distinct numbers of departments in
                                                        the
                                                        data?</h6>
                                                    
                                                    <textarea class="form-control w-100" id="" cols="30"
                                                        rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="pt-3 pb-3">
                                                <h6 class="fw-normal">Could you tell the date range in the data?</h6>
                                                
                                                <textarea class="form-control w-100" id="" cols="30" rows="5"></textarea>
                                            </div>


                                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                <button class="btn btn-primary btn-sm px-3" onclick="sub_next(1, 1, 5)">
                                                    Submit <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                                </button>
                                            </div>

                                            

                                            <div style="display:none">
                                                <div class="card mt-3">
                                                    <!-- 4 -->
                                                    <div class="card-header" id="aws_1_cont">
                                                        ANSWER - EDA (Statistic)
                                                    </div>
                                                    <div class="card-body">
                                                        <h6>How much average weekly sales per store?</h6>
                                                        <p>In PivotChart, drag store column to Legend (Series)</p>
                                                        <p>Drag Average of weekly sales to Values</p>

                                                        <br>

                                                        <div class="pb-3">
                                                            <h6>Which stores is having highest average weekly sales?</h6>
                                                            
                                                            <textarea id="aws_1" class="form-control w-100" id=""
                                                                rows="5"></textarea>
                                                        </div>

                                                        <br>

                                                        <div class="pb-3">
                                                            <h6>Which stores is having lowest average weekly sales?</h6>
                                                            
                                                            <textarea class="form-control w-100" id="" rows="5"></textarea>
                                                        </div>

                                                        <br>

                                                        <div class="pb-3">
                                                            <h6>Which month is having the average highest temperature?</h6>
                                                            <p>In PivotChart, drag Date column to Rows</p>
                                                            <p>Drag Average of Temperature to Values</p>
                                                            
                                                            <textarea class="form-control w-100" id="" rows="5"></textarea>
                                                        </div>

                                                        <br>

                                                        <div class="pb-3">
                                                            <h6>Which month is having the average highest fuel price?</h6>
                                                            <p>In PivotChart, drag Date column to Rows</p>
                                                            <p>Drag Average of Fuel Price to Values</p>
                                                            
                                                            <textarea class="form-control" id="" rows="5"></textarea>
                                                        </div>

                                                        <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                            <a href="#aws_2_cont">
                                                                <button class="btn btn-primary btn-sm px-3">
                                                                    Submit <i
                                                                        class="far fa-arrow-alt-circle-right ps-2"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card mt-3">
                                                    <!-- 5 -->
                                                    <div class="card-header" id="aws_2_cont">
                                                        ANSWER - Data Cleaning
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="pb-3" id="aws_2_cont">
                                                            <h6>Which columns having missing values?</h6>
                                                            <p>Filter each columns, see if a column is containing BLANKS</p>
                                                            <textarea id="aws_2" class="form-control w-100" id=""
                                                                rows="5"></textarea>
                                                        </div>
                                                        <br>

                                                        <div class="pb-3">
                                                            <h6>If any, please fill the missing values</h6>
                                                            <p>Find average values for the missing columns, and fill the
                                                                blank
                                                                with
                                                                it!</p>
                                                            <textarea class="form-control w-100" id="" rows="5"></textarea>
                                                        </div>

                                                        <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                            <button class="btn btn-primary btn-sm px-3"
                                                                onclick="sub_next(1, 1, 5)">
                                                                Submit <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-allin collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#c-p5-1-2" aria-expanded="false"
                                            aria-controls="c-p5-1-2">
                                            <i class="far fa-check-circle pe-2" id="ds-icon5-1-2"></i>
                                            Analyze the Data
                                        </button>
                                    </h2>
                                    <div id="c-p5-1-2" class="accordion-collapse collapse">
                                        <div class="accordion-body">

                                            <div>Try to get some insights about weekly sales by answering these questions:
                                            </div>

                                            <div class="pt-3 pb-3">
                                                <h6 class="fw-normal">How many different store types in the data?</h6>
                                                
                                                <textarea class="form-control w-100" id="" cols="30" rows="5"></textarea>
                                            </div>

                                            <div class="pt-3 pb-3">
                                                <h6 class="fw-normal">How much average weekly sales per store?</h6>
                                                
                                                <textarea class="form-control w-100" id="" cols="30" rows="5"></textarea>
                                            </div>

                                            <hr>
                                            <div>Which stores have</div>
                                            <div class="sub-border">
                                                <div class="pt-3 pb-3 ms-4">
                                                    <h6 class="fw-normal">The highest average weekly sales?</h6>
                                                    
                                                    <textarea class="form-control w-100" id="" cols="30"
                                                        rows="5"></textarea>
                                                </div>

                                                <div class="pt-3 pb-3 ms-4">
                                                    <h6 class="fw-normal">The lowest average weekly sales?</h6>
                                                    
                                                    <textarea class="form-control w-100" id="" cols="30"
                                                        rows="5"></textarea>
                                                </div>

                                                <div class="pt-3 pb-3 ms-4">
                                                    <h6 class="fw-normal">The average highest temperature?</h6>
                                                    <textarea class="form-control w-100" id="" cols="30"
                                                        rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="pt-3 pb-3">
                                                <h6 class="fw-normal">Which month is having the average highest fuel
                                                    price?</h6>
                                                <textarea class="form-control w-100" id="" cols="30" rows="5"></textarea>
                                            </div>


                                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                <button class="btn btn-primary btn-sm px-3" onclick="sub_next(1, 2, 5)">
                                                    Submit <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-allin collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#c-p5-1-3" aria-expanded="false"
                                            aria-controls="c-p5-1-3">
                                            <i class="far fa-check-circle pe-2" id="ds-icon5-1-3"></i>
                                            Data Cleaning
                                        </button>
                                    </h2>
                                    <div id="c-p5-1-3" class="accordion-collapse collapse">
                                        <div class="accordion-body">

                                            <div>After you understand the data, try to clean it up!
                                            </div>

                                            <div class="pt-3 pb-3">
                                                <h6 class="fw-normal">Which columns having missing values? If any,
                                                    please fill the missing values</h6>
                                                
                                                <hr class="my-1">
                                                <br>
                                                Please upload your worksheet below
                                                <br>
                                                <input type="file" class="form-control">
                                            </div>


                                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                <button class="btn btn-primary btn-sm px-3" onclick="sub_next(1, 3, 5)">
                                                    Submit <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-allin collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#c-p5-1-4" aria-expanded="false"
                                            aria-controls="c-p5-1-4">
                                            <i class="far fa-check-circle pe-2" id="ds-icon5-1-4"></i>
                                            Case Study Answer
                                        </button>
                                    </h2>

                                    <div id="c-p5-1-4" class="accordion-collapse collapse">
                                        <div class="accordion-body" style="text-align: left;">
                                            
                                            <div>
                                                <h4>Coming soon</h4>
                                            </div>
                                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                <button class="btn btn-info btn-sm px-3" onclick="sub_next(1, 4, 5)">
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

                <div class="accordion-item accordion-parent">
                    <h2 class="accordion-header" id="p5-2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#c-p5-2" aria-expanded="false" aria-controls="c-p5-2">
                            <i class="far fa-check-circle pe-2" id="ds-icon5-2"></i>
                            Case Study #2
                        </button>
                    </h2>

                    <div id="c-p5-2" class="accordion-collapse collapse" aria-labelledby="p5-2" data-bs-parent="#p5">
                        <div class="accordion-body">
                            <div class="pc">
                                <p>From the data that has been provided on the previous case study, try to turn it into
                                    visualization!
                                </p>

                                

                                <textarea class="form-control w-100 mb-3" id="" rows="5"></textarea>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="p5-2-1">
                                        <button class="accordion-button bg-allin collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#c-p5-2-1" aria-expanded="false"
                                            aria-controls="c-p5-2-1">
                                            <i class="far fa-check-circle pe-2" id="ds-icon5-2-1"></i>
                                            Data Visualization
                                        </button>
                                    </h2>

                                    <div id="c-p5-2-1" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <h6>We will help you determine the suitable graph so you could get better
                                                understanding of the raw data that you have proceed:
                                            </h6>

                                            <div>Now please try to create :</div>
                                            <ol class="ol-cst mt-2">
                                                <li>Time series graph:
                                                    <ol type="a" class="mt-2">
                                                        <li>on weekly sales per store</li>
                                                        <li>on temperature</li>
                                                        <li>on fuel price</li>
                                                    </ol>

                                                    <hr class="my-1">
                                                    <br>
                                                    Please upload your worksheet below
                                                    <br>
                                                    <input type="file" class="form-control">
                                                    <br>
                                                </li>
                                                <li>Bar graph showing average weekly sales per store

                                                    <hr class="my-1">
                                                    <br>
                                                    Please upload your worksheet below
                                                    <br>
                                                    <input type="file" class="form-control">
                                                    <br>
                                                </li>
                                                <li>Scatter plot showing relationship between weekly sales and temperature.

                                                    <hr class="my-1">
                                                    <br>
                                                    Please upload your worksheet below
                                                    <br>
                                                    <input type="file" class="form-control">
                                                    <br>
                                                </li>
                                            </ol>

                                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                <button class="btn btn-primary btn-sm px-3" onclick="sub_next(2, 1, 5)">
                                                    Submit <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="p5-2-2">
                                        <button class="accordion-button bg-allin collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#c-p5-2-2" aria-expanded="false"
                                            aria-controls="c-p5-2-2">
                                            <i class="far fa-check-circle pe-2" id="ds-icon5-2-2"></i>
                                            Simple Model Building
                                        </button>
                                    </h2>

                                    <div id="c-p5-2-2" class="accordion-collapse collapse">
                                        <div class="accordion-body">

                                            <div></div>

                                            <ul>
                                                <h6>After completing the data visualization, try to make the model building!
                                                </h6>

                                                <br>

                                                <h6>Which column/columns is/are our target variable?</h6>
                                                <li><span>Hint: Pick Weekly Sales as our target variable, and other numeric
                                                        columns as
                                                        predictor</span></li>

                                                <hr class="my-1">
                                                <br>
                                                Please upload your worksheet below
                                                <br>
                                                <input type="file" class="form-control">

                                                <br>

                                                <h6>How many column/columns is/are eligible as features for linear
                                                    regression?
                                                </h6>
                                                <li>
                                                    <spam>Hint: Choose columns with numeric value!</spam>
                                                </li>

                                                <hr class="my-1">
                                                <br>
                                                Please upload your worksheet below
                                                <br>
                                                <input type="file" class="form-control">

                                                <br>

                                                <h6>Create simple linear regression with those columns!</h6>
                                                Hint:
                                                <li>Let’s create linear regression with formula of y = m1x1 + m2x2 + m3x3 +
                                                    m4x4
                                                    + m5x5 + b
                                                </li>
                                                <li>Type LINEST(E2:E5771;H2:L5771) in column M</li>
                                                <li>M to Q columns are the value of m1 to m5, while R column is the value of
                                                    b
                                                </li>

                                                <hr class="my-1">
                                                <br>
                                                Please upload your worksheet below
                                                <br>
                                                <input type="file" class="form-control">
                                            </ul>
                                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                <button class="btn btn-primary btn-sm px-3" onclick="sub_next(2, 2, 5)">
                                                    Submit <i class="far fa-arrow-alt-circle-right ps-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-allin collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#c-p5-2-3" aria-expanded="false"
                                            aria-controls="c-p5-2-3">
                                            <i class="far fa-check-circle pe-2" id="ds-icon5-2-3"></i>
                                            Case Study Answer
                                        </button>
                                    </h2>

                                    <div id="c-p5-2-3" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            
                                            <div>
                                                <h4>Coming soon</h4>
                                            </div>

                                            <div class="col-md-12 text-end mt-4 pt-2 border-top">
                                                <button class="btn btn-info btn-sm px-3" onclick="sub_next(2, 3, 5)">
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
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // sessionStorage.clear();
            let n = $('.accordion-item').length
            for (i = 1; i <= n; i++) {
                for (j = 1; j <= n; j++) {
                    if (sessionStorage.getItem('c-p5-' + i + '-' + j)) {
                        $('#ds-icon5-' + i + '-' + j).removeClass('far fa-check-circle')
                        $('#ds-icon5-' + i + '-' + j).addClass('fas fa-check-circle text-success')
                    }
                }
                if (sessionStorage.getItem('c-p5-' + i) == 'read') {
                    $('#ds-icon5-' + i).removeClass('far fa-check-circle')
                    $('#ds-icon5-' + i).addClass('fas fa-check-circle text-success')
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
            sessionStorage.setItem("c-p5-" + n, "read");
            if (sessionStorage.getItem('c-p5-' + n) == 'read') {
                $('#ds-icon5-' + n).removeClass('far fa-check-circle')
                $('#ds-icon5-' + n).addClass('fas fa-check-circle text-success')
            }

            let next = n + 1
            $('#c-p5-' + n).collapse('toggle');
            $('#c-p5-' + next).collapse('toggle');

            let j = $('.accordion-item').length
            let z = 0
            for (i = 0; i <= j; i++) {
                if (sessionStorage.getItem('c-p5-' + i) == 'read') {
                    z++
                }
            }

            if (z == j) {
                sessionStorage.setItem("part" + part, "done");
                if (sessionStorage.getItem('part' + part) == 'done') {
                    $('#ds-iconPart' + part).addClass('fas fa-check-circle float-end mt-1 text-success')
                    window.location = "<?php echo url('/data-scientist/reflection'); ?>";
                }
            }
        }

        function sub_next(n, index, part) {
            sessionStorage.setItem("c-p5-" + n + "-" + index, "read");
            if (sessionStorage.getItem('c-p5-' + n + "-" + index) == 'read') {
                $('#ds-icon5-' + n + '-' + index).removeClass('far fa-check-circle')
                $('#ds-icon5-' + n + '-' + index).addClass('fas fa-check-circle text-success')
            }

            let next = index + 1
            $('#c-p5-' + n + "-" + index).collapse('toggle');
            $('#c-p5-' + n + "-" + next).collapse('toggle');

            let j = $('#c-p5-' + n + ' .accordion-item').length
            let z = 0
            for (i = 0; i <= j; i++) {
                if (sessionStorage.getItem('c-p5-' + n + '-' + i) == 'read') {
                    z++
                }
            }

            if (z == j) {
                sessionStorage.setItem("c-p5-" + n, "read");
                if (sessionStorage.getItem('c-p5-' + n) == 'read') {
                    $('#ds-icon5-' + n).removeClass('far fa-check-circle')
                    $('#ds-icon5-' + n).addClass('fas fa-check-circle text-success')
                }

                let k = $('.accordion-parent').length
                let m = 0
                for (i = 0; i <= k; i++) {
                    if (sessionStorage.getItem('c-p5-' + i) == 'read') {
                        m++
                    }
                }

                if (m == k) {
                    sessionStorage.setItem("part" + part, "done");
                    if (sessionStorage.getItem('part' + part) == 'done') {
                        $('#ds-iconPart' + part).addClass('fas fa-check-circle float-end mt-1 text-success')
                        window.location = "<?php echo url('/data-scientist/reflection'); ?>";
                    }
                }

                let next2 = n + 1
                $('#c-p5-' + n).collapse('toggle');
                $('#c-p5-' + next2).collapse('toggle');
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/data-scientist-part/case-studies.blade.php ENDPATH**/ ?>