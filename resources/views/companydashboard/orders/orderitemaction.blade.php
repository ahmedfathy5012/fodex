<?php 
 $orderitem = \App\Models\OrderItem::where('id',$id)->first();
 ?>
    <div style="cursor:pointer;" onclick="deleteitemorder({{$id}})" class="btn btn-sm btn-hover-bg-light mr-1">
                                <span class="svg-icon svg-icon-danger m-0 p-0 svg-icon-md"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo8/dist/../src/media/svg/icons/Home/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </div>
                                 <span class="btn btn-danger"  data-toggle="modal" data-target="#myModale{{$id}}">الكميه</span>
                                 <div id="myModale{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> الكميه</h4>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-6">
            <label>الكميه</label>
            <input type="number" value="{{$orderitem->quantity}}" min ="1" id="quantity{{$id}}">
          
        </div>
        </div>
        <div class="row">
            <button class="btn btn-primary mx-auto mt-4" 
           onclick="changequantity({{$id}})" >حفظ</button>
            </div>
      </div>
     
    </div>

  </div>
</div>
                               <script>
              function deleteitemorder(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
     Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
      console.log(id);
    $.ajax({
       type:"delete",
       url: `../deleteitemorder/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
         )
       }
       table.ajax.reload();
       $(".mt-5").load(`https://fodex.dawena.net/public/showorders/${result.order_id} .mt-5`);
           }
    });
    }
  })
}
 function changequantity(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
      
    $.ajax({
       type:"post",
       url: `../changequantity`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           "id":sel,
           "quantity":$(`#quantity${id}`).val()
       },
       success: function(result){
  
         $(`#myModale${id}`).modal('hide');
   
       table.ajax.reload();
          $(".mt-5").load(`https://fodex.dawena.net/public/showorders/${result.order_id} .mt-5`);
           }
 
  })
}
 
  </script>