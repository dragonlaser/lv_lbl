<template>
    <section id="contact" class="dark-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="section-title">
						<h2>ติดต่อเรา</h2>
						<p>If you have some Questions or need Help! Please Contact Us!<br>We make Cool and Clean Design for your Business</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="section-text">
						<h4>Our Business Office</h4>
						<p>3422 Street, Barcelona 432, Spain, New Building North, 15th Floor</p>
						<p><i class="fa fa-phone"></i> +101 377 655 22125</p>
						<p><i class="fa fa-envelope"></i> mail@yourcompany.com</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="section-text">
						<h4>Business Hours</h4>
						<p><i class="fa fa-clock-o"></i> <span class="day">Weekdays:</span><span>9am to 8pm</span></p>
						<p><i class="fa fa-clock-o"></i> <span class="day">Saturday:</span><span>9am to 2pm</span></p>
						<p><i class="fa fa-clock-o"></i> <span class="day">Sunday:</span><span>Closed</span></p>
					</div>
				</div>


				<div class="col-md-6">
					<form name="sentMessage" id="contactForm" @submit.prevent="addPost">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Your Name *" v-model="post.name">
									<p class="help-block text-danger"></p>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<input v-model="post.email" type="email" class="form-control" placeholder="Your Email *" id="email" required="" data-validation-required-message="Please enter your email address.">
									<p class="help-block text-danger"></p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<select class="form-control rounded-0" v-model="post.contact_type_id">
										<option value="">ประเภทการติดต่อ</option>
										<option v-bind:value="val.message" v-for="val in items" >{{val.message}}</option>
									</select>
									<p class="help-block text-danger"></p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" v-model="post.detail" placeholder="Your Message *" id="message" required="" data-validation-required-message="Please enter a message."></textarea>
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							<div class="col-lg-12 text-center">
								<div id="success"></div>
								<button type="submit" class="btn">Send Message</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
import axios from 'axios'
export default {
	name:'Contact',
	data: function() {
		return {
			items : [
				{ message: 'เว็ปขายของออนไลน์' },
				{ message: 'โปรแกรมใช้งานภายใน' },
				{ message: 'โปรแกรมบัญชี' },
				{ message: 'โปรแกรมสต็อกสินค้า' },
				{ message: 'โปแกรมบริหารบุคคล' }
			],
			post:{},
			posts:[],
			contact_type_list:null
		}
	},

	methods: {
		addPost(){
			console.log(this.post)
			//let url = '/api/post/create';
			// this.axios.post(url, this.post).then((response) => {
			// 	this.$router.push({name: 'posts'});
			// });
		},
		
		// addValue: function () {
		// 	console.log(this);
		// 	this.posts.push(this.data);
		// }
	},
	mounted () {
			axios
			.get('http://localhost:8000/admin/manages/contact_type_list')
			.then(response => (this.contact_type_list = response.data),console.log(this.response))
	}
}
</script>
