<div class="view">
    <div class="modal fade" id="modal_options">
        <div style="width: 90%; margin-left: auto; margin-right: auto; margin-top: 3%">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group" style="margin-top: 1%">

                        <div class="title f_left">
                            <h4>Selecione as opções desejadas.</h4>
                        </div>
                        <div class="f_right">
                            <button data-dismiss="modal"  class="btn btn-default">Voltar</button>
                        </div>

                        <br><br><br>

                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Qtd</th>
                                    <th>Imagen</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 0 ?>
                                @foreach($options as $option)
                                <tr style="cursor: pointer">
                                    <td>{{ $option->id }}</td>
                                    <td>
                                        <input onchange="valTotalPizza(1)" name="pizza[1][option][{{ $option->id }}]" type="number" min="0" max="20" id="optionNumberPizza"  price="{{ $option->price }}" optionName="{{ $option->name }}" class="form-control" style="width:60px">
                                    </td>
                                    <td>
                                        <img id="imgOption" class="img-rounded img-responsive" src="#" width="80">
                                    </td>
                                    <td>{{ $option->name }}</td>
                                    <td>R$ {{ $option->price }}</td>
                                </tr>
                                <?php $cont++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>
</div>
