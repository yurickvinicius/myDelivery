
@if(Session::has('message_success'))
<div class="alert alert-success" style="width: 90%; margin-right: auto; margin-left: auto">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 style="float: left; margin-right: 1%">Sucesso: </h4>
    {{Session::get("message_success")}}
</div>
@endif