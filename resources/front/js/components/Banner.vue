<template>
    <header>
            <div class="container">
                <div class="slider-container">
                    <div class="intro-text">
                        <div class="intro-heading" >
                            {{banner_title[0].title}}
                        </div>
                        <a href="#about" class="page-scroll btn btn-xl">ขอใบเสนอราคา</a>
                    </div>
                </div>
            </div>
    </header>
</template>

<script>
    import axios from 'axios'
    export default {
        name:'Banner',
        data () {
        return {
                banner_title: null,
            }
        },
        mounted () {
            axios
            .get('http://localhost:8000/api/menu')
            .then(response => (this.banner_title = response.data))
        }
    }   

</script>
