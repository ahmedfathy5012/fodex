<style>
    .fa-heart{
        font-size:19px;
        cursor:pointer;
    } .fa-heart:hover{
        color:red;
        font-size:19px;
        cursor:pointer;
    }
</style>
<?php 
 $seller_id = request()->route('id');
$sel = \App\Models\Sellercategory::where([['category_id','=',$id],['seller_id','=',$seller_id]])->first(); 
//$id1 = $sel->category_id;
?>
<input type="checkbox"  onchange="add_category_seller({{$id}},{{$seller_id}})"   @if($sel) checked @endif
                            value="1">
                      @if($sel)
        <i class="fas fa-heart"   onclick="addfav({{$sel->id}})"  @if($sel->fav == 1) style="color:red;" @endif></i>
                                
                             <span  class="btn btn-success btn-sm" style="font-size:11px;color:white;" data-toggle="modal" data-target="#myModals{{$id}}">
    الترتيب</span>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

  
<div id="myModals{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">الترتيب </h4>
      </div>
      <div class="modal-body">
        <div class="row">
     <div class="col-6">
         <label>الترتيب</label>
         <input type="number" required  min="0" value="{{$sel->order_number}}"
         name="order_number" id="order_number{{$sel->id}}" class="form-control">
     </div>
     
      </div>
<div class="row">
    <div class="col-3"></div>
     <div class="col-3">
         <input type="button" onclick="order_numberres({{$sel->id}})" 
         value="حفظ" class="form-control btn btn-success btn-sm m-4">
     </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
                      @endif
                            <script>
  function addfav(sel){
    let id = sel;
 console.log(sel);
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      type:"get",
      url: `../addfav1/${id}`,
  //    contentType: "application/json; charset=utf-8",
      dataType: "Json",
      success: function(result){
          if(result.status == true){

  table.ajax.reload();
      }
     
          }
  })
}function order_numberres(sel){
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
       url: `../order_numbercategory`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       data:{
           'id':sel,
             'order_number':$(`#order_number${id}`).val()
       },
       success: function(result){
           if(result.status == true){
  

Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'تم اضافه الترتيب بنجاح',
  showConfirmButton: false,
  timer: 1500
})
   $(`#myModals${id}`).modal('hide');
       table.ajax.reload();
           }
       }
  })
} function add_category_seller(category_id,seller_id){
 
 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      type:"post",
      url: `../add_category_seller`,
  //    contentType: "application/json; charset=utf-8",
      dataType: "Json",
      data:{
          'seller_id':seller_id,
          'category_id':category_id
      },
      success: function(result){
          if(result.status == true){

  table.ajax.reload();
      }
     
          }
  })
}</script>