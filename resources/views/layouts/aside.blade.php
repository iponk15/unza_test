<!--begin::Brand-->
<div class="brand flex-column-auto " id="kt_brand">
    <!--begin::Logo-->
    <a href="index.html" class="brand-logo">
        <img alt="Logo" class="w-65px" src="{{ asset('assets/media/logos/logo-letter-13.png') }}"/>
    </a>
    <!--end::Logo-->
</div>
<!--end::Brand-->

<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div
        id="kt_aside_menu"
        class="aside-menu my-4  aside-menu-dropdown "
        data-menu-vertical="1"
        data-menu-dropdown="1" data-menu-scroll="0" data-menu-dropdown-timeout="500">
        
        <!--begin::Menu Nav-->
        <ul class="menu-nav ">
            <li class="menu-item  menu-item-active" aria-haspopup="true" >
                <a  href="{{ route('home') }}" class="menu-link ajaxify"><i class="menu-icon flaticon2-architecture-and-city"></i><span class="menu-text">Home</span></a>
            </li>
            <li class="menu-item  menu-item-active" aria-haspopup="true" >
                <a  href="{{ route('distributor.index') }}" class="menu-link ajaxify"><i class="menu-icon flaticon-cart"></i><span class="menu-text">Distributor</span></a>
            </li>
        </ul>
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->