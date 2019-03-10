
<template>
    <nav class="navbar navbar-default navbar-fixed-top d-flex">
		<div class="container">
			<div class="navbar-header page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand page-scroll" href="#page-top"><img class="set_logo" src="../../import/images/lbl.png" alt="lbl logo"></a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li> 
						<a class="page-scroll" href="/#">หน้าแรก</a>
					</li>
					<li>
						<a class="page-scroll" href="/#about">เกี่ยวกับเรา</a>
					</li>
					<li>
						<a class="page-scroll" href="/#services">บริการ</a>
					</li>
					<li>
						<a class="page-scroll" href="/#portfolio">ผลงาน</a>
					</li>
					<li>
						<a class="page-scroll" href="/#team">ติดต่อเรา</a>
					</li>
					<li>
						<router-link class="page-scroll" to="/detail">detail</router-link>
					</li>
					<li>
						<router-link class="page-scroll" to="/Category">Category</router-link>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>

<script>
	export default {
		name:'Navbarfix'
	}
</script>

    
