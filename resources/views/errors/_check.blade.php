@if($errors->any())
<div class="alert alert-danger" style="width: 90%; margin-right: auto; margin-left: auto">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 style="float: left; margin-right: 1%">Erros: </h4><br>
    <ul class="alert">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
