<template>
    <div>
        <section class="my-5">
            <div class="container">
                <img src="../../import/images/demo/slide02.jpg" class="w-100" alt="">
                <div>
                    <h2 class="heading">OUR VETERINARY PRACTICE</h2>
                    <div class="detail-port-time text-right mb-4">
                        <span><i class="fa fa-calendar" aria-hidden="true"></i> 20.11.2019</span> | 
                        <span><i class="fa fa-user-o" aria-hidden="true"></i> Duru Brown</span>
                    </div>
                    <div v-for="value in info">
                         <!-- { "id": 1, "name": "cerulean", "year": 2000, "color": "#98B2D1", "pantone_value": "15-4020" } -->
                        <p>{{value.id}}</p>
                        <p>{{value.name}}</p>
                        <p>{{value.year}}</p>
                        <p>{{value.color}}</p>
                        <p>{{value.pantone_value}}</p>
                        <hr>
                    </div>
                    <div v-for="value in test">
                         <!-- { "id": 1, "name": "cerulean", "year": 2000, "color": "#98B2D1", "pantone_value": "15-4020" } -->
                        <p>{{value.id}}</p>
                        <p>{{value.name}}</p>
                        <p>{{value.year}}</p>
                        <p>{{value.color}}</p>
                        <p>{{value.pantone_value}}</p>
                        <hr>
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
            info: null,
            test:null
        }
    },
    mounted () {
        axios
        .get('https://reqres.in/api/unknown')
        .then(response => (this.info = response.data.data))
        ,
        axios
        .get('https://reqres.in/api/unknown')
        .then(response => (this.test = response.data.data))
    }
}
</script>