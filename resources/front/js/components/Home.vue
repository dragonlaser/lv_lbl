<template>
    <div>
        <Banner></Banner>
        <About></About>
        <Services></Services>
        <Weare></Weare>
        <Ourproject></Ourproject>
        <Ourclients></Ourclients>
        <team></team>
        <Contact></Contact>
    </div>
</template>

<script>
    import About from './About.vue';
    import Banner from './Banner.vue';
    import Services from './Services.vue';
    import Weare from './Weare.vue';
    import Ourproject from './Our-project.vue';
    import Ourclients from './Our-clients.vue';
    import team from './Our-team.vue';
    import Contact from './Contact.vue';
    export default {
        name:'Home',
        components:{
            About,
            Banner,
            Services,
            Weare,
            Ourproject,
            Ourclients,
            team,
            Contact,
        }
    }
</script>