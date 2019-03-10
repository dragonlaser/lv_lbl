
<template>
    <section id="about" class="dark-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>4 ขั้นตอน การทำงานเปิดงาน</h2>
                        <p>A creative agency based on Candy Land, ready to boost your business with some beautifull templates. MOOZ Agency is one of the best in town see more you will be amazed.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 text-center" v-for="i in 4">
                    <div class="mz-module-about">
                        <i class="fa fa-laptop ot-circle"></i>
                        <h3>Web Development</h3>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div>
            </div>
        </div>
            <!-- /.container -->
    </section>
</template>

<script>
import axios from 'axios'
export default {
    name:'About',
    }
</script>

    
