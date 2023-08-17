<?php 
$order =\App\Models\Order::where('id',$id)->first();

?>
<style>
    .span{
      width: 160px !important;
    margin-top: 3px;
    }
     .fa-star.checked {
  color: orange;
}
</style>
   <a href="{{route('showorders',$id)}}"  ><img src="{{asset('visibility.png')}}" style="width:25px;height:25px;"></a>
                        
