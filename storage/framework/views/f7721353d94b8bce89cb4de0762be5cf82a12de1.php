<?php $__env->startSection('title'); ?>
    Digital Marketing | Core Tasks
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
                <h3>What does a Digital Marketing
                    Specialist do?</h3>
            </div>
            <hr class="m-1 border-2 mx-auto" width="95%">
            <div class="card-body">
                <div class="row mt-3 lh-lg">
                    <div class="col-md-12 mb-3">
                        <h5 class="my-0">Core Tasks</h5>
                        <hr class="my-0 mb-3">
                        <ul style="margin-left:-10px;">
                            <li><strong>Understand</strong> the social media platforms that your audience
                                uses</li>
                            <li><strong>Understand</strong> how to make use of social media tools and
                                features</li>
                            <li><strong>Plan</strong> marketing strategy through different platforms</li>
                            <li><strong>Manage</strong> all digital marketing activities on social media,
                                search engines, etc.</li>
                            <li><strong>Manage</strong> social media marketing and content</li>
                            <li><strong>Improve</strong> search engine rankings</li>
                            <li><strong>Improve</strong> company's online reputation</li>
                            <li><strong>Ensure</strong> that the user's digital experience is seamless</li>
                        </ul>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h5 class="my-0">Digital Marketing Framework (5A)</h5>
                        <hr class="my-0 mb-3">
                        <img class="img" src="<?php echo e(asset('img/data-marketing/5a.png')); ?>" width="100%">
                        <b>Aware:</b><br>
                        You want your audience to see your advertising both online and offline.
                        <hr class="m-0 mb-2">
                        <b>Appeal:</b> <br>
                        You want your audience to be interested about your product or service
                        <hr class="m-0 mb-2">
                        <b>Ask:</b><br>
                        You want your audience to be curious and ask about your product or service or look
                        for a review in order for them to learn more about it.
                        <hr class="m-0 mb-2">
                        <b>Act:</b> <br>
                        You want your customers to make the decision to buy your product or service.
                        <hr class="m-0 mb-2">
                        <b>Advocate:</b><br>
                        You want your customers to enjoy your product or service, so that they leave a
                        positive review on social media or advocate their experience to their friends and
                        family.
                        <hr class="my-3">
                        <div class="text-end">
                            <button class="btn btn-info btn-sm px-3" onclick="next(1, 2)">
                                Next <i class="far fa-arrow-alt-circle-right ps-2"></i>
                            </button>
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
                if (sessionStorage.getItem('part2-' + i) == 'read') {
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

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/digital-marketing/part-2.blade.php ENDPATH**/ ?>