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

						<div class="item">
							<div class="owl-portfolio-item"><img src="../../import/images/demo/portfolio-7.jpg" class="img-responsive" alt="portfolio"></div>
						</div>
						<div class="item">
							<div class="owl-portfolio-item"><img src="../../import/images/demo/portfolio-8.jpg" class="img-responsive" alt="portfolio"></div>
						</div>
						<div class="item">
							<div class="owl-portfolio-item"><img src="../../import/images/demo/portfolio-9.jpg" class="img-responsive" alt="portfolio"></div>
						</div>

					</carousel>
					<!-- <div class="owl-portfolio owl-carousel">
						<div class="item">
							<div class="owl-portfolio-item"><img src="../../import/images/demo/portfolio-7.jpg" class="img-responsive" alt="portfolio"></div>
						</div>
						<div class="item">
							<div class="owl-portfolio-item"><img src="../../import/images/demo/portfolio-8.jpg" class="img-responsive" alt="portfolio"></div>
						</div>
						<div class="item">
							<div class="owl-portfolio-item"><img src="../../import/images/demo/portfolio-9.jpg" class="img-responsive" alt="portfolio"></div>
						</div>
					</div> -->

				</div>
			</div>
		</div>
	</section>
</template>

<script>

import carousel from 'vue-owl-carousel'
export default {
    name:'Weare',
	components: { carousel },
}
</script>

