<template>
    <div>
        <section class="my-5">
            <div class="container">
                <img src="../../import/images/demo/slide02.jpg" class="w-100" alt="">
                <div>
                    <h2 class="heading">{{banner_title.title}}</h2>
                    <div class="detail-port-time text-right mb-4">
                        <span><i class="fa fa-calendar" aria-hidden="true"></i> 20.11.2019</span> | 
                        <span><i class="fa fa-user-o" aria-hidden="true"></i> Duru Brown</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>

//get api

import axios from 'axios'

export default {
    name:'Detail',
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