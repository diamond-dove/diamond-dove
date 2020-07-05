<template>
    <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
        <notifications></notifications>

        <side-bar
                :sidebar-item-color="sidebarBackground"
                :sidebar-background-image="sidebarBackgroundImage"
        >
            <mobile-menu slot="content"></mobile-menu>
            <sidebar-link to="/dashboard">
                <md-icon>dashboard</md-icon>
                <p>Inicio</p>
            </sidebar-link>
            <sidebar-link to="/clients">
                <md-icon>person</md-icon>
                <p>CLIENTES</p>
            </sidebar-link>
        </side-bar>


        <div class="main-panel">
            <top-navbar></top-navbar>

            <dashboard-content> </dashboard-content>

            <content-footer v-if="!$route.meta.hideFooter"></content-footer>
        </div>

    </div>
</template>

<script>
    import TopNavbar from "./TopNavbar.vue";
    import ContentFooter from "./ContentFooter.vue";
    import DashboardContent from "./Content.vue";
    import MobileMenu from "./MobileMenu.vue";
    import FixedPlugin from "./Extra/FixedPlugin.vue";

    export default {
        components: {
            TopNavbar,
            ContentFooter,
            DashboardContent,
            MobileMenu,
            FixedPlugin
        },
        name: "Dashboardlayout",
        data() {
            return {
                sidebarBackground: "green",
                sidebarBackgroundImage: require("../../../assets/img/sidebar-2.jpg")
            };
        }
    }
</script>

<style scoped>

</style>
