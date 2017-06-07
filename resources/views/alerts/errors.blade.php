<?php 
$message=Session::get('message-error');
//echo "VARIABLE->".$message."<br>";
?>

@if($message)
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message-error')}}
</div>
@endif