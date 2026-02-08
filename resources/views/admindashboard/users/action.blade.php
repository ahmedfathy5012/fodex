   <a href="{{route('user_orders',$id)}}" title="الطلبات"><img src="{{asset('order-food.png')}}"  class="order_icon"></a>
   <?php $user = \App\User::where("id",$id)->first();?>
   <input class='input-switch' type="checkbox" id="demo{{$id}}" @if($user->block == 0) checked @endif  onchange="block_user({{$id}})"/>
<label class="label-switch" for="demo{{$id}}"></label>
<span class="info-text"></span>
 <a href="{{route('user_profile',$id)}}" title="البروفايل"><img src="{{asset('user.png')}}"        
 class="img-lgmb-4" style="height: 35px;
    width: 35px;
    max-height: 100%;
    max-width: 100%;
    border-radius: 50%;"alt="profile image"></a>
<style>


.input-switch{
	display: none;
}

.label-switch{
	display: inline-block;
	position: relative;
	    float: left;
    /* margin-bottom: 11px; */
    margin-top: 7px;
    margin-right: 10px;
}

.label-switch::before, .label-switch::after{
	content: "";
	display: inline-block;
	cursor: pointer;
	transition: all 0.5s;
}

.label-switch::before {
    width: 3em;
    height: 1em;
    border: 1px solid #757575;
    border-radius: 4em;
    background: #888888;
}

.label-switch::after {
    position: absolute;
    left: 0;
    top: -20%;
    width: 1.5em;
    height: 1.5em;
    border: 1px solid #757575;
    border-radius: 4em;
    background: #ffffff;
}

.input-switch:checked ~ .label-switch::before {
    background: #00a900;
    border-color: #008e00;
}

.input-switch:checked ~ .label-switch::after {
    left: unset;
    right: 0;
    background: #00ce00;
    border-color: #009a00;
}

.info-text {
	display: inline-block;
}

.info-text::before{
	content: "block";
}

.input-switch:checked ~ .info-text::before{
	content: "un block";
}
</style>
<script>
             
 function block_user(id){
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
   
    $.ajax({
       type:"get",
       url: `block_user/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
           if(result.status == true){

           }
       }
    });
 
}</script>
