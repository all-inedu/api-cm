<ul class="list-group" id="sidebar-list">
    <li class="list-group-item <?php echo e(Request::is('data-scientist/1') ? 'sidebar-active' : 'sidebar-unactive'); ?>"><a class="sidebar-elements" id="part-0" href="<?php echo e(url('data-scientist/1')); ?>">Part 1</a></li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/2') ? 'sidebar-active' : 'sidebar-unactive'); ?>"><a class="sidebar-elements" id="part-1" href="<?php echo e(url('data-scientist/2')); ?>">Part 2</a></li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/3') ? 'sidebar-active' : 'sidebar-unactive'); ?>"><a class="sidebar-elements" id="part-2" href="<?php echo e(url('data-scientist/3')); ?>">Part 3</a></li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/4') ? 'sidebar-active' : 'sidebar-unactive'); ?>"><a class="sidebar-elements" id="part-3" href="<?php echo e(url('data-scientist/4')); ?>">Part 4</a></li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/case-studies') ? 'sidebar-active' : 'sidebar-unactive'); ?>"><a class="sidebar-elements" id="part-4" href="<?php echo e(url('data-scientist/case-studies')); ?>">Case Studies</a></li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/reflection') ? 'sidebar-active' : 'sidebar-unactive'); ?>"><a class="sidebar-elements" id="part-5" href="<?php echo e(url('data-scientist/reflection')); ?>">Reflection</a></li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/glossary') ? 'sidebar-active' : 'sidebar-unactive'); ?>"><a class="sidebar-elements" id="part-6" href="<?php echo e(url('data-scientist/glossary')); ?>">Glossary</a></li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/other-resources') ? 'sidebar-active' : 'sidebar-unactive'); ?>"><a class="sidebar-elements" id="part-7" href="<?php echo e(url('data-scientist/other-resources')); ?>">Other Resources</a></li>
</ul>
<script>
    var element = $(".sidebar-elements");

    element.mousedown(function(){
        var active = $(".sidebar-active")
        active.removeClass("sidebar-active")
        active.addClass("sidebar-unactive")

        var parent = $(this).parent("li");
        parent.addClass("sidebar-active")
        parent.removeClass("sidebar-unactive")
    });
</script>
<?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/modules/data-scientist-part/sidebar.blade.php ENDPATH**/ ?>