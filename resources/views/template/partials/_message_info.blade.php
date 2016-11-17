
@if(Session::has('message_info'))
<div class="alert alert-info" style="width: 90%; margin-right: auto; margin-left: auto">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 style="float: left; margin-right: 1%">Informação: </h4>
    {{Session::get("message_info")}}
</div>
@endif
