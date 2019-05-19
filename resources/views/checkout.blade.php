@extends('layout.layout')

@section('title','GOCAMP')

@section('content')

<!-- Page Preloder -->
<div id="preloder">
		<div class="loader"></div>
</div>

<!-- Header section -->
<header class="header-section">
		<div class="header-top">
				<div class="container">
						<div class="row">
								<div class="col-lg-2 text-center text-lg-left">
										<!-- logo -->
										<a href="/" class="site-logo">
												<img src="{{ url('img/logogocamp.png') }}" alt="">
										</a>
								</div>
								<div class="col-xl-6 col-lg-5">
										<form class="header-search-form">
												<input type="text" placeholder="Search on gocamp ....">
												<button><i class="flaticon-search"></i></button>
										</form>
								</div>
								<div class="col-xl-4 col-lg-5">
										<div class="user-panel">
										@if (Route::has('login'))
												<div class="up-item">
														<i class="flaticon-profile"></i>
														@auth
														<a href="/home"> {{ Auth::user()->nama }}</a>
														@else
														<a href="{{ route('login') }}">Sign</a> In or <a href="{{ route('register') }}">Create Account</a>
														@endauth
												</div>
										@endif
												<div class="up-item">
														<div class="shopping-card">
																<i class="flaticon-bag"></i>
																<span><?php if(null !== session('cart')) echo count(session('cart')); ?></span>
														</div>
														<a href="{{ url('cart') }}">Shopping Cart</a>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
		<nav class="main-navbar">
				<div class="container">
						<!-- menu -->
						<ul class="main-menu">
								<li><a href="../">Home</a></li>
								<li><a href="./contact.html">Contact Us</a></li>
								<li><a href="./about.html">About Us</a></li>
						</ul>
				</div>
		</nav>
</header>
<!-- Header section end -->
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Your cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form method="post" action="{{url('/checkoutproses')}}" class="checkout-form">
						{{ csrf_field() }}
						
						@foreach (session('cart') as $id => $details)

								
						<input type="hidden" name="id_barang" value="{{$details['id_barang']}}"></input>
						<input type="hidden" name="id_customer" value="{{$details['id_customer']}}"></input>
						@endforeach
						<div class="cf-title">Billing Address</div>
						<div class="row">
							<div class="col-md-7">
								<p>*Billing Information</p>
							</div>
							<div class="col-md-5">
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="text" name="alamat" placeholder="alamat">
							</div>
							<div class="col-md-6">
								<input type="text" name="zipcode" placeholder="Zip code">
							</div>
							<div class="col-md-6">
								<input type="text" name="notelp" placeholder="Phone no.">
							</div>
						</div>
						<div class="cf-title">Delievery Info</div>
						<div class="row shipping-btns">
							<div class="col-6">
								<h4>Tanggal Sewa</h4>
							</div>
							<div class="col-6">
								<div class="cf-radio-btns">
									<div class="cfr-item">
										<?php $date = date('d-m-Y');  echo $date;  ?>
										<input type="hidden" name="tanggalsewa" value="{{ $date }}">
									</div>
								</div>
							</div>
							<div class="col-6">
								<h4>Tanggal Kembali  </h4>
							</div>
							<div class="col-6">
								<div class="cf-radio-btns">
									<div class="cfr-item">

										<?php $datesum = date('d-m-Y', strtotime($date.' + '.$lamasewa.' days')); echo $datesum ?>
										<input type="hidden" name="tanggalkembali" value="{{ $datesum }}">
									</div>
								</div>
							</div>
						</div>
						<div class="cf-title">Payment</div>
						<ul class="payment-list">
							<?php $payment = DB::table('payment')->get();?>
							@foreach ($payment as $payment)
							<li>
							<input type="radio" name="payment" value="{{$payment->id_payment}}">{{ $payment->tipepembayaran ." ". $payment->norek }}</input>
						</li>
							@endforeach
						</ul>
						<button type="submit" class="site-btn submit-order-btn">Place Order</button>
					
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<?php $total = 0;?>
						@foreach (session('cart') as $id => $details)

						<ul class="product-list">
							<li>
								<div class="pl-thumb"><img src="{{ asset('storage/product/'.$details['image'])}}" alt=""></div>
								<h6>{{ $details['nama'] }}</h6>
								<?php
								$hargaqty = $details['harga'] * $details['qty'];

								$total += $details['harga'] * $details['qty'];
								?>
								<p>{{ "Rp " . $hargaqty }}</p>
							</li>
						</ul>
						@endforeach
						<ul class="price-list">
							<li>Total<span>{{ $total }}</span></li>
							<li>Shipping<span><?php $ship=20000; echo $ship; ?></span></li>
							<li>Lama Sewa<span>{{ $lamasewa . " Hari" }}</span></li>
							<li class="total">Total<span>{{ $lamasewa * $total + $ship }}</span></li>
							<?php $total = $lamasewa * $total + $ship; ?>
							<input type="hidden" name="jumlahbayar" value="{{$total}}"" name="">

						</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->

	<!-- Footer section -->
	<section class="footer-section">
			<div class="container">
				<div class="social-links">
					<a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
					<a href="" class="google-plus"><i class="fa fa-google-plus"></i><span>g+plus</span></a>
					<a href="" class="pinterest"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
					<a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
					<a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
					<a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
					<a href="" class="tumblr"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
				</div>

<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

			</div>
		</div>
	</section>
	<!-- Footer section end -->



	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>

@endsection
