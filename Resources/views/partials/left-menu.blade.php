<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            @foreach($modules as $section_name => $section)
            <li class="active open">
                <a href="javascript:;">
                    <i class="{{ $sections[$section_name]['icon'] }}"></i>
                    <span class="title">{{ $sections[$section_name]['name'] }}</span>
                    <span class="arrow "></span>
                </a>

                <ul class="sub-menu">
                    @foreach($section as $module)
                    <li {!! request()->segment(2) == $module->name ? 'class="active"' : '' !!}>

                        <a href="{{ route($module->name.'.index') }}">{{ $module->title }}</a>

                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>