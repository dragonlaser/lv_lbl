<template>
    <section id="portfolio">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>ผลงานของเรา</h2>
						<p>Our portfolio is the best way to show our work, you can see here a big range of our work. Check them all and you will find what you are looking for.</p>
					</div>
				</div>
			</div>
			<div class="row row-0-gutter">
				<!-- start portfolio item -->
				<div class="col-md-4 col-0-gutter" v-for="value in portfolio_title">
					<router-link to="/detail">
						<div class="ot-portfolio-item">
							<figure class="effect-bubba">
								<img src="../../import/images/demo/portfolio-1.jpg" alt="img02" class="img-responsive" />
								<figcaption>
									<h2>{{value.title}}</h2>
									<p>{{value.detail}}</p>
								</figcaption>
							</figure>
						</div>
					</router-link>
				</div>
			</div>
				<!-- end portfolio item -->
		</div><!-- end container -->
	</section>
</template>
<script>
import axios from 'axios'
export default {
	name:'Our-project',
	data () {
	return {
			portfolio_title: null,
		}
	},
	mounted () {
			axios
			.get('http://localhost:8000/api/menu')
			.then(response => (this.portfolio_title = response.data[0].front_sub_menu))
	} 
}
</script>
