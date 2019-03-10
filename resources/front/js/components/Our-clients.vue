<template>
    <section>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>ลูกค้าของเรา</h2>
						<p>Mida sit una namet, cons uectetur adipiscing adon elit.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<carousel :autoplay="true" :items=7 :margin=10>
						<div v-for="n in 10">
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
	export default {
		
		name:'Ourclients',
		components: { carousel },
	};

</script>
