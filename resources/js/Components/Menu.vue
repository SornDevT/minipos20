<template lang="">
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

        
        <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">


        </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">sneat</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <!-- {{ $route }} -->

        <ul class="menu-inner py-1">

        <!-- Dashboards -->
        <li class="menu-item " :class="$route.path=='/store'?'active':''">
            <router-link to="/store" class="menu-link e">
            <i class='menu-icon bx bx-store-alt'></i>
            <div class="text-truncate" data-i18n="Dashboards">Store</div>
            </router-link>
        </li>

        <li class="menu-item " :class="$route.path=='/pos'?'active':''">
            <router-link to="/pos" class="menu-link e">
            <i class='menu-icon bx bx-cart'></i>
            <div class="text-truncate" data-i18n="Dashboards">ຂາຍ POS</div>
            </router-link>
        </li>

        <li class="menu-item " :class="$route.path=='/transection'?'active':''">
            <router-link to="/transection" class="menu-link e">
            <i class='menu-icon bx bx-transfer-alt'></i>
            <div class="text-truncate" data-i18n="Dashboards">ການເຄື່ອນໄຫວ</div>
            </router-link>
        </li>

        <li class="menu-item " :class="$route.path=='/report'?'active':''">
            <router-link to="/report" class="menu-link e">
            <i class='menu-icon bx bx-bar-chart-alt-2'></i>
            <div class="text-truncate" data-i18n="Dashboards">ລາຍງານ</div>
            </router-link>
        </li>

        

        </ul>

        </aside>
</template>
<script>
export default {
    
}
</script>
<style lang="">
    
</style>