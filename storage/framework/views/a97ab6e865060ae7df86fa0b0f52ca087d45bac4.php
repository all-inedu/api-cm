<?php $__env->startSection('title'); ?>
    Digital Marketing | Glossary
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
                <h3>Glossary</h3>
            </div>
            <hr class="m-1 border-2 mx-auto" width="95%">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <b>CSS</b> - Cascading Style Sheets is a style sheet language used for describing the
                                presentation of a
                                document written in a markup language
                                <hr>
                                <b>Google Adwords</b> - Google AdWords is a pay-per-click online advertising platform that
                                allows
                                advertisers to display their ads on Google's search engine results page.
                                <hr>
                                <b>HTML</b> - Hypertext Markup Language is the standard markup language for documents
                                designed
                                to be
                                displayed in a web browser
                                <hr>
                                <b>Marketing Funnel</b> - a consumer-focused marketing model that illustrates the
                                theoretical customer journey toward the purchase of a good or service.
                                <hr>
                                <b>Pay-per-click</b> - Pay-per-click is an internet advertising model used to drive traffic
                                to
                                websites, in
                                which an advertiser pays a publisher when the ad is clicked.
                                <hr>
                                <b>SEM</b> - Search Engine Marketing, form of Internet marketing that involves the promotion
                                of
                                websites by
                                increasing their visibility in search engine results pages primarily through paid
                                advertising.
                                <hr>
                                <b>SEO</b> - Search Engine Optimization, the process of improving the quality and quantity
                                of
                                website
                                traffic to a website or a web page from search engines.
                                <hr>
                                <b>SWOT Analysis</b> - a strategic planning technique used to help a person or organization
                                identify strengths, weaknesses, opportunities, and threats related to business competition
                                or project planning.
                                <hr>
                                <b>Value Proposition Canvas</b> - a tool which can help ensure that a product or service is
                                positioned around what the customer values and needs
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="text-end">
                            <button class="btn btn-info btn-sm px-3" onclick="next(1, 7)">
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
            sessionStorage.setItem("dm-part" + part, "done");

            let nextPart = part + 1
            window.location.href = "<?php echo e(url('digital-marketing/part-')); ?>" + nextPart;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.module.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/digital-marketing/part-7.blade.php ENDPATH**/ ?>