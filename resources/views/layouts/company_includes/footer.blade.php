<!--end::Global Config-->
	<!--begin::Footer-->
  <!--<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">-->
			<!--begin::Container-->
		<!--	<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">-->
				<!--begin::Copyright-->
		<!--		<div class="text-dark order-2 order-md-1">-->
		<!--			<span class="text-muted font-weight-bold mr-2">2021©</span>-->
		<!--			<a href="#" target="_blank" class="text-dark-75 text-hover-primary">Crazyidea</a>-->
		<!--		</div>-->
				<!--end::Copyright-->
				<!--begin::Nav-->
		<!--		<div class="nav nav-dark">-->
		<!--		</div>-->
				<!--end::Nav-->
		<!--	</div>-->
			<!--end::Container-->
		<!--</div>-->
		<!--end::Footer-->
	</div>
	<!--end::Wrapper-->
	
</div>
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>

<!--end::Global Theme Bundle-->
<!-- <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script> -->
<script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{asset('btn.js')}}"></script>

    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>

	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

	<script src="{{asset('custom/app.js')}}"></script>
<script>
     $(".selectpicker").selectpicker();
       $("div.hidden").clone(true);
	   let loader = document.getElementById('preloader');
window.addEventListener('load', function () {
  loader.style.display = 'none';
});
$(document).ready(function() {
  $('.summernote').summernote();
});
    </script>
@yield('scripts')


       @if(session('success'))
	   <script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title:"{{session('success')}}",
  showConfirmButton: false,
  timer: 1500
})

    </script>
	@endif
<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>