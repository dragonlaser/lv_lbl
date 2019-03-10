<template>
    <div class="container">
        <section class="my-5">
            <h2 class="heading mb-5">หมวดหมู่</h2>
            <div class="row">
                <div v-for="value in info" class="col-sm-6 col-lg-4 mb-4">
                    <div class="card border-0">
                        <router-link  to="/detail">
                            <div class="cat-img">
                                <img class="fix-img" src="../../import/images/demo/slider1.jpg" alt="...">
                            </div>
                        </router-link>
                        <div class="card-body px-0">
                            <div class="detail-port-time mb-2">
                                <span><i class="fa fa-calendar" aria-hidden="true"></i> 20.11.2019</span> | 
                                <span><i class="fa fa-user-o" aria-hidden="true"></i> Duru Brown</span>
                            </div>
                            <div class="cat-title-link">
                                <router-link to="/detail">
                                    <h4>{{value.name}}</h4>
                                </router-link>
                            </div>
                            <p class="cat-exc">{{value.pantone_value}}</p>
                            <router-link class="btn cat-btn-link" to="/detail" role="button">Read More..</router-link>
                        </div>
                    </div>
                    <!-- <input type="text" class="from-control" v-bind:placeholder="value.pantone_value"> -->
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name:'Category',
     data () {
            return {
                info: null,
            }
        },
        mounted () {
            axios
            .get('https://reqres.in/api/unknowns')
            .then(response => (this.info = response.data.data,console.log(response.data.data)))
        }
}

</script>

