<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 10 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../../">
	<meta charset="utf-8" />
	<!-- <title>Fodex</title> -->
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/3/3a/Order_station.png" type="image">
	<title>Order Station</title>
	<meta name="description" content="Login page example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<!--begin::Fonts-->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
<!-- <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@800&display=swap" rel="stylesheet">   -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
  <!--end::Fonts-->
	<!--begin::Page Custom Styles(used by this page)-->
	<link href="{{asset('assets/css/pages/login/login-2.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Page Custom Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="{{asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->
	<!-- <link rel="shortcut icon" href="{{asset('fodexlogo.jpg')}}" /> -->

	<style>
		#preloader {
			position: fixed;
			inset: 0;
			width: 100%;
			height: 100vh;
			z-index: 999999;
			display: flex;
			align-items: center;
			justify-content: center;
			background: radial-gradient(circle at top right, rgba(54, 153, 255, 0.12), transparent 35%),
					radial-gradient(circle at bottom left, rgba(27, 197, 189, 0.12), transparent 35%),
					#f8fafc;
		}

		.real-delivery-loader {
			width: 460px;
			min-height: 380px;
			background: rgba(255, 255, 255, 0.95);
			border: 1px solid #edf0f5;
			border-radius: 32px;
			box-shadow: 0 30px 80px rgba(15, 23, 42, 0.14);
			backdrop-filter: blur(14px);
			padding: 28px 24px 30px;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			text-align: center;
			overflow: hidden;
			position: relative;
		}

		.real-delivery-loader::before {
			content: "";
			position: absolute;
			width: 210px;
			height: 210px;
			border-radius: 50%;
			background: rgba(54, 153, 255, 0.08);
			top: -85px;
			right: -85px;
		}

		.real-delivery-loader::after {
			content: "";
			position: absolute;
			width: 160px;
			height: 160px;
			border-radius: 50%;
			background: rgba(27, 197, 189, 0.09);
			bottom: -65px;
			left: -65px;
		}

		.real-delivery-scene {
			width: 380px;
			height: 230px;
			position: relative;
			z-index: 2;
			margin-bottom: 10px;
			overflow: hidden;
		}

		.real-delivery-bike {
			position: absolute;
			width: 220px;
			height: auto;
			right: 10px;
			bottom: 28px;
			z-index: 3;
			object-fit: contain;
			animation: realBikeRun 2.4s linear infinite;
			filter: drop-shadow(0 20px 22px rgba(15, 23, 42, 0.20));
		}

		.real-delivery-road {
			position: absolute;
			left: 20px;
			right: 20px;
			bottom: 28px;
			height: 9px;
			border-radius: 999px;
			background: #dfe6ee;
			overflow: hidden;
			z-index: 1;
		}

		.real-delivery-road span {
			position: absolute;
			top: 2px;
			width: 58px;
			height: 5px;
			border-radius: 999px;
			background: #ffffff;
			animation: realRoadMove 0.8s linear infinite;
		}

		.real-delivery-road span:nth-child(1) {
			left: 0;
		}

		.real-delivery-road span:nth-child(2) {
			left: 130px;
			animation-delay: 0.2s;
		}

		.real-delivery-road span:nth-child(3) {
			left: 260px;
			animation-delay: 0.4s;
		}

		.real-delivery-speed-lines {
			position: absolute;
			inset: 0;
			z-index: 0;
			pointer-events: none;
		}

		.real-delivery-speed-lines span {
			position: absolute;
			height: 4px;
			border-radius: 999px;
			background: linear-gradient(90deg, transparent, rgba(54, 153, 255, 0.45), transparent);
			animation: speedLineMove 0.7s linear infinite;
		}

		.real-delivery-speed-lines span:nth-child(1) {
			width: 140px;
			top: 62px;
			left: 20px;
		}

		.real-delivery-speed-lines span:nth-child(2) {
			width: 190px;
			top: 104px;
			left: -40px;
			animation-delay: 0.15s;
		}

		.real-delivery-speed-lines span:nth-child(3) {
			width: 160px;
			top: 148px;
			left: 25px;
			animation-delay: 0.3s;
		}

		.real-delivery-speed-lines span:nth-child(4) {
			width: 120px;
			top: 182px;
			left: -10px;
			animation-delay: 0.45s;
		}

		.real-delivery-loader h4 {
			margin: 0;
			font-size: 20px;
			font-weight: 900;
			color: #181c32;
			position: relative;
			z-index: 2;
		}

		.real-delivery-loader p {
			margin: 9px 0 18px;
			font-size: 13px;
			font-weight: 700;
			color: #7e8299;
			position: relative;
			z-index: 2;
		}

		.real-delivery-progress {
			width: 230px;
			height: 7px;
			border-radius: 999px;
			background: #edf0f5;
			overflow: hidden;
			position: relative;
			z-index: 2;
		}

		.real-delivery-progress span {
			display: block;
			width: 42%;
			height: 100%;
			border-radius: 999px;
			background: linear-gradient(90deg, #3699ff, #1bc5bd, #ffa800);
			animation: realProgressRun 1.15s ease-in-out infinite;
		}

		@keyframes realBikeRun {
			0% { transform: translateX(-150px) translateY(0) rotate(0deg); }
			25% { transform: translateX(-112px) translateY(-3px) rotate(-0.5deg); }
			50% { transform: translateX(-75px) translateY(0) rotate(0deg); }
			75% { transform: translateX(-38px) translateY(-3px) rotate(-0.5deg); }
			100% { transform: translateX(0) translateY(0) rotate(0deg); }
		}

		@keyframes realRoadMove {
			from { transform: translateX(360px); }
			to { transform: translateX(-100px); }
		}

		@keyframes speedLineMove {
			from { transform: translateX(230px); opacity: 0; }
			35% { opacity: 1; }
			to { transform: translateX(-190px); opacity: 0; }
		}

		@keyframes realProgressRun {
			0% { transform: translateX(170%); }
			100% { transform: translateX(-270%); }
		}

		@media (max-width: 576px) {
			.real-delivery-loader {
				width: 92%;
				min-height: 330px;
				padding: 22px 16px;
			}

			.real-delivery-scene {
				width: 310px;
				height: 190px;
			}

			.real-delivery-bike {
				--bike-travel: -105px;
				width: 190px;
				right: 12px;
			}

			.real-delivery-progress {
				width: 190px;
			}
		}

		.carousel .carousel-inner .carousel-item img {
			width: 70%;
			margin: 0 auto;
			height: 400px;
		}

		.login-aside {
			background-image: linear-gradient(#BE93C5, #7BC6CC);
		}
	</style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
		id="kt_login">
			<!--begin::Aside-->
			<div class="login-aside order-1 order-lg-2 d-flex flex-row-auto position-relative overflow-hidden" >
				<!--begin: Aside Container-->
				<div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
					<!--begin::Logo-->
					<a href="#" class="text-center pt-2">

								                        <img src="{{ asset('assets/loaders/modern_delivery_logo_design_clean_transparent.png') }}" class="max-h-100px" alt="" />
						<!-- <img src="{{asset('fodexlogo.jpg')}}" class="max-h-100px" alt="" /> -->
					</a>
					<!--end::Logo-->
					<!--begin::Aside body-->
					<div class="d-flex flex-column-fluid flex-column flex-center">
						<!--begin::Signin-->
						<div class="login-form login-signin py-11">
							<!--begin::Form-->
							<form class="form" id="kt_login_signin_form" method="post" action="{{route('login')}}">
								@csrf
								<!--begin::Title-->
								<div class="text-center pb-8">
									<h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg" style="text-transform: capitalize;">تسجيل الدخول</h2>
								</div>
								<!--end::Title-->
								<!--begin::Form group-->
								<div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark float-right">الاسم</label>
									<input class="form-control form-control-solid " type="text" placeholder="الاسم" name="name" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group">

										<label class="font-size-h6 font-weight-bolder text-dark pt-5 float-right">كلمه السر</label>

									<input class="form-control form-control-solid" type="password" placeholder="كلمه السر" name="password" autocomplete="off" />
								</div>

								@if(session('error'))
								<p class="text-danger">{{ session('error')  }}</p>
								@endif
								<!--end::Form group-->
								<div class="form-group d-flex flex-wrap
								justify-content-between align-items-center px-8 float-right">
									<div class="checkbox-inline">
										<label class="checkbox checkbox-outline checkbox-white text-white m-0">
											<input type="checkbox" name="remember" value="true" />
											<span></span>تذكرنى </label>
									</div>

								</div>
								<!--begin::Action-->
								<div class="text-center pt-4">
									<button type="submit" class="btn btn-dark font-weight-bolder
									font-size-h6 px-8 py-4 my-3" style="text-transform: capitalize;">تسجيل الدخول</button>
								</div>
								<div class="row">

								</div>
								<!--end::Action-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signin-->
					</div>
					<!--end::Aside body-->
				</div>
				<!--end: Aside Container-->
			</div>
			<!--begin::Aside-->
			<!--begin::Content-->
			<div class="content order-2 order-lg-1 d-flex flex-column w-100 pb-0"
			style="background-color: #fff;">
				<!--begin::Image-->
							<div id="preloader">
								<div class="real-delivery-loader">
									<div class="real-delivery-scene">
										<div class="real-delivery-speed-lines">
											<span></span>
											<span></span>
											<span></span>
											<span></span>
										</div>

										<img class="real-delivery-bike"
										     src="{{ asset('assets/loaders/orderstation-delivery-bike.png') }}"
										     alt="delivery bike loader">

										<div class="real-delivery-road">
											<span></span>
											<span></span>
											<span></span>
										</div>
									</div>

									<h4>OrderStation</h4>
									<p>جاري تجهيز صفحة تسجيل الدخول...</p>

									<div class="real-delivery-progress">
										<span></span>
									</div>
								</div>
							</div>
				<!--end::Image-->
				<!--<div class="text-center">-->
				<!--	<p class="my-3 h5">جميع الحقوق محفوظه @ <span class="alina"> Enjoy </span> 2021</p>-->
				<!--</div>-->
				<!--<div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{asset('assets/media/svg/illustrations/truck4.png);')}}"></div>-->
				<!--end::Image-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Login-->
	</div>
	<!--end::Main-->
	<script>
		var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
	</script>
	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1400
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#3699FF",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#E4E6EF",
						"dark": "#181C32"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1F0FF",
						"secondary": "#EBEDF3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#3F4254",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#EBEDF3",
					"gray-300": "#E4E6EF",
					"gray-400": "#D1D3E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#7E8299",
					"gray-700": "#5E6278",
					"gray-800": "#3F4254",
					"gray-900": "#181C32"
				}
			},
			"font-family": "Poppins"
		};
	</script>
	<!--end::Global Config-->
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
	<script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
	<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
	<!--end::Global Theme Bundle-->
	<script>
		FormValidation.formValidation(
			document.getElementById('kt_login_signin_form'), {
				fields: {
					name: {
						validators: {
							notEmpty: {
								message: 'name is required'
							},
						}
					},
					//    password: {
					//     validators: {
					//      notEmpty: {
					//       message: 'password is required'
					//      },
					//     }
					//    },
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
	</script>
	<!--end::Page Scripts-->
	<script>
		@if(session('error'))
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: "{{session('error')}}",
		})
		@endif
		@if(session('success'))
		Swal.fire({
			position: 'top-end',
			icon: 'success',
			title: "{{session('success')}}",
			showConfirmButton: false,
			timer: 1500
		})
		@endif
	</script>
	<script>
		let loader = document.getElementById('preloader');
		window.addEventListener('load', function () {
			if (loader) {
				loader.style.display = 'none';
			}
		});
	</script>
</body>
<!--end::Body-->

</html>
