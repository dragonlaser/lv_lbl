<template>
    <section class="light-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="section-text">
						<h3>ทำไม ต้องเลือกเรา ?</h3>
						<p>Our portfolio is the best way to show our work, you can see here a big range of our work. Check them all and you will find what you are looking for.</p>
						<ul>
							<li>Good Job
							งานดี คุ้มค่า ราคาเหมาะสม</li>
							<li>Good Quality
							งานคุณภาพ เทคโนโลยีสมัยใหม่</li>
							<li>Be Happy
							ตอบโจทย์ ตรงใจ ตรงกับธุรกิจ</li>

						</ul>
					</div>
				</div>
				<div class="col-md-5">
					<carousel :autoplay="true" :items=1 >

						<div class="item" v-for="i in 10">
							<div class="owl-portfolio-item"><img src="../../import/images/demo/portfolio-7.jpg" class="img-responsive" alt="portfolio"></div>
						</div>

					</carousel>

				</div>
			</div>
		</div>
	</section>
</template>

<script>

import carousel from 'vue-owl-carousel'
import axios from 'axios'
export default {
    name:'Weare',
	components: { carousel },
	data () {
	return {
					Services_title: null,
					Services_Card: null,
			}
	},
	mounted () {
			axios
			.get('http://localhost:8000/api/menu')
			.then(response => (this.Services_title = response.data)),
			axios
			.get('http://localhost:8000/api/menu')
			.then(response => (this.Services_Card = response.data[0].front_sub_menu))
	} 
}
</script>

