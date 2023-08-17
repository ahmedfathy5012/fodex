<?php 
$employee = \App\Models\Employee::where('id',$id)->first();
?>
<a href="{{route('employee.edit',$id)}}" class="btn btn-sm btn-hover-bg-light m-0">
                                
                                <span class="svg-icon svg-icon-primary m-0 p-0 svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                        </g>
                                    </svg>
                                </span>
                                
                            </a>

                            <div style="cursor:pointer;" onclick="deleteemployee({{$id}})" class="btn btn-sm btn-hover-bg-light mr-1">
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
                             <a class="btn btn-primary btn-sm" href="{{route('employeecontracts',$id)}}"> contracts</a>
                              <a class="btn btn-primary btn-sm" href="{{route('countriespermissions',$id)}}"> صلاحيات المناطق</a>
                            @if($employee->block == 1)
                            <span class="btn btn-primary" onclick="blockemployee({{$id}})" >الغاء البلوك</span>
                            @else
                            <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal{{$id}}">بلوك</button>

<!-- Modal -->
<div id="myModal{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">اسباب البلوك</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-12">
               <label>
                   السبب
               </label>
               <input type="text" class="form-control" id="block_reason{{$id}}">
           </div>
              <div class="col-12">
               <label>
                   السبب المعلن
               </label>
               <input type="text" class="form-control" id="display_block_reason{{$id}}">
           </div>
       </div>
       <div class="row">
           <input type="button"  onclick="blockemployee({{$id}})" class="btn btn-sm btn-primary mr-4" value="حفظ">
       </div>
      </div>
    </div>

  </div>
</div>
                            @endif
                              <!-- award -->
                            <span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalaward{{$id}}">مكافأه</span>
<!-- Modal -->
<div id="myModalaward{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> سبب المكافأه</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-8">
               <label>
                   القيمه
               </label>
               <input type="number" class="form-control" id="value{{$id}}">
           </div>
              <div class="col-12">
               <label>
                   السبب 
               </label>
               <input type="text" class="form-control" id="reason{{$id}}">
           </div>
       </div>
       <div class="row mt-4">
           <input type="button"  onclick="awardemployee({{$id}})" class="btn btn-sm btn-primary mr-4" value="حفظ">
       </div>
      </div>
    </div>

  </div>
</div>
  <!-- discount -->
                            <span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModaldiscount{{$id}}">خصم</span>
<!-- Modal -->
<div id="myModaldiscount{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> سبب الخصم</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-8">
               <label>
                   القيمه
               </label>
               <input type="number" class="form-control" id="valuediscount{{$id}}">
           </div>
              <div class="col-12">
               <label>
                   السبب 
               </label>
               <input type="text" class="form-control" id="reasondiscount{{$id}}">
           </div>
       </div>
       <div class="row mt-4">
           <input type="button"  onclick="discountemployee({{$id}})" class="btn btn-sm btn-primary mr-4" value="حفظ">
       </div>
      </div>
    </div>

  </div>
</div>
                 
                           
                            <script>
              function deleteemployee(sel){
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
       url: `employee/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){
     Swal.fire(
      'Deleted!',
      'تم المسح بنجاح',
      'success'
         )
         
       }
       table.ajax.reload();
           }
    });
    }
  })
}
//
         function blockemployee(sel){
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
      url: `blockemployee`,
  //    contentType: "application/json; charset=utf-8",
      dataType: "Json",
      data:{
          'id':id,
          'block_reason':$(`#block_reason${id}`).val(),
          'display_block_reason':$(`#display_block_reason${id}`).val()
      },
      success: function(result){
          if(result.status == true){
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تمت بنجاح ',
  showConfirmButton: false,
  timer: 1500
})
$(`#myModal${id}`).modal('hide');
  table.ajax.reload();
      }
     
          }
  })
}
///award
function awardemployee(sel){
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
      url: `awardemployee`,
  //    contentType: "application/json; charset=utf-8",
      dataType: "Json",
      data:{
          'id':id,
          'reason':$(`#reason${id}`).val(),
          'value':$(`#value${id}`).val()
      },
      success: function(result){
          if(result.status == true){
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تمت اضافه المكافأه بنجاح ',
  showConfirmButton: false,
  timer: 1500
})
$(`#myModalaward${id}`).modal('hide');
  table.ajax.reload();
      }
     
          }
  })
}///discount
function discountemployee(sel){
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
      url: `discountemployee`,
  //    contentType: "application/json; charset=utf-8",
      dataType: "Json",
      data:{
          'id':id,
          'reason':$(`#reasondiscount${id}`).val(),
          'value':$(`#valuediscount${id}`).val()
      },
      success: function(result){
          if(result.status == true){
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تمت اضافه الخصم بنجاح ',
  showConfirmButton: false,
  timer: 1500
})
$(`#myModaldiscount${id}`).modal('hide');
  table.ajax.reload();
      }
     
          }
  })
}
</script>