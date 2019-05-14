@extends('layout.layout')

@section('title','GOCAMP PRODUCT')

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

	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
					<!-- <input type="date" name=""> -->
						<h3>Your Cart</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="size-th">SizeSize</th>
									<th class="total-th">Price</th>
								</tr>
							</thead>
							<tbody>
<?php $total = 0 ?>
@if (session('cart'))
	@foreach (session('cart') as $id => $details)
		<?php $total += $details['harga'] * $details['qty'] ?>
								<tr>
									<td class="product-col">
										<img src="{{ asset('storage/product/'.$details['image'])}}" alt="">
										<div class="pc-title">
											<h4>{{ $details['nama'] }}</h4>
											<p>{{ $details['harga'] }} / Hari</p>
										</div>
									</td>
									<td class="quy-col">
										<div class="quantity">
					                        <div class="pro-qty">
												<input type="text" value="{{ $details['qty'] }}">
											</div>
                    					</div>
									</td>
									<td class="size-col"><h4>{{ $details['size'] }}</h4></td>
									<td class="total-col"><h4>{{ $details['harga'] * $details['qty'] }}</h4></td>
								</tr>
							</tbody>
	@endforeach
@endif
						</table>
						</div>
						<div class="total-cost">
							<h6>Total <span>{{ $total }}</span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">
					<form class="promo-code-form">
						<input type="text" placeholder="Enter promo code">
						<button>Submit</button>
					</form>
					@if (Route::has('login'))
					@auth
					<a href="/checkout" class="site-btn">Proceed to checkout</a>
					<a href="{{ url('/apus') }}" class="site-btn sb-dark">Continue shopping</a>
					@else
					<a href="{{ url('/login') }}" class="site-btn sb-dark">Login to Checkout</a>
					<a href="{{ url('/apus') }}" class="site-btn sb-dark">Continue shopping</a>
					@endauth
					@endif
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->




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
