<ul class="list-group rounded-0" id="sidebar-list">
    <li class="list-group-item <?php echo e(Request::is('data-scientist/1') ? 'active' : ''); ?>"">
        <a class=" sidebar-elements" id="part-0" href="<?php echo e(url('data-scientist/1')); ?>">
        <i class="fas fa-tachometer fa-fw"></i>
        INTRODUCTION <i class="" id="ds-iconPart1"></i>
        </a>
    </li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/2') ? 'active' : ''); ?>">
        <a class="sidebar-elements" id="part-1" href="<?php echo e(url('data-scientist/2')); ?>">
            <i class="fas fa-tasks fa-fw"></i>
            CORE TASKS <i class="" id="ds-iconPart3"></i>
        </a>
    </li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/3') ? 'active' : ''); ?>">
        <a class="sidebar-elements" id="part-2" href="<?php echo e(url('data-scientist/3')); ?>">
            <i class="fas fa-tag fa-fw"></i>
            TYPES <i class="" id="ds-iconPart2"></i>
        </a>
    </li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/4') ? 'active' : ''); ?>">
        <a class="sidebar-elements" id="part-3" href="<?php echo e(url('data-scientist/4')); ?>">
            <i class="fas fa-bezier-curve fa-fw"></i>
            PATHWAY <i class="" id="ds-iconPart4"></i>
        </a>
    </li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/case-studies') ? 'active' : ''); ?>">
        <a class="sidebar-elements" id="part-4" href="<?php echo e(url('data-scientist/case-studies')); ?>">
            <i class="fas fa-marker fa-fw"></i>
            CASE STUDY <i class="" id="ds-iconPart5"></i>
        </a>
    </li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/reflection') ? 'active' : ''); ?>">
        <a class="sidebar-elements" id="part-5" href="<?php echo e(url('data-scientist/reflection')); ?>">
            <i class="far fa-file-alt fa-fw"></i>
            REFLECTION <i class="" id="ds-iconPart6"></i>
        </a>
    </li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/glossary') ? 'active' : ''); ?>">
        <a class="sidebar-elements" id="part-6" href="<?php echo e(url('data-scientist/glossary')); ?>">
            <i class="fas fa-book fa-fw"></i>
            GLOSSARY
        </a>
    </li>
    <li class="list-group-item <?php echo e(Request::is('data-scientist/other-resources') ? 'active' : ''); ?>">
        <a class="sidebar-elements" id="part-7" href="<?php echo e(url('data-scientist/other-resources')); ?>">
            <i class="fas fa-link fa-fw"></i>
            ADDITIONAL
            RESOURCES
        </a>
    </li>
</ul>
<script>
    var element = $(".sidebar-elements");

    element.mousedown(function() {
        var active = $(".active")
        active.removeClass("active")
        active.addClass("")

        var parent = $(this).parent("li");
        parent.addClass("active")
        parent.removeClass("")
    });

</script>
<?php /**PATH /home/u5332263/public_html/others/github/career-module/resources/views/layout/module/sidebar-ds.blade.php ENDPATH**/ ?>