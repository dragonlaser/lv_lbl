<template>
    <section id="services">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>{{Services_title[0].title}}</h2>
						<p>{{Services_title[0].detail}}</p>
					</div>
				</div>
			</div>
			
			<div class="row">
				
				<div class="col-md-3 text-center" v-for="value in 4">
					<div class="mz-module-about">
						<i class="fa fa-laptop ot-circle"></i>
						<h3>{{Services_Card[value-1].detail}}</h3>
						<p>{{Services_Card[value-1].detail}}</p>
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
	 name:'Services',

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

