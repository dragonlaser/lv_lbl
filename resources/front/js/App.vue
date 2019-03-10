<template>
    <div id="app">
        <Navbarfix></Navbarfix>
        <router-view></router-view>
        <Footer></Footer>
    </div>
</template>

<style lang="css">
    @import '../import/css/style.css';
    @import '../import/css/bootstrap.min.css';
    @import '../import/css/bootstrap-theme.css';
    @import 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css';
</style>

<script>
    import '../import/js/bootstrap.min.js';
    import '../import/js/cbpAnimatedHeader.js';
    import '../import/js/jquery.appear.js';
    import '../import/js/mooz.themes.scripts.js';
    import 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js';
    import 'http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js';
</script>

<script>
    import Navbarfix from './components/Navbarfix.vue';
    import Footer from './components/Footer.vue';
    export default {
        name:'App',
        components:{
            Navbarfix,
            Footer,
        }
    }
</script>