<div class="view">
    <div class="modal fade" id="modal_cad_flavors_pizza_1">
        <div style="width: 90%; margin-left: auto; margin-right: auto; margin-top: 3%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Escolher no maxímo <span id="spanMaxPiecesPizza" style="margin-left: 5px" class="badge">2</span> Sabores</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin-top: 1%">
                        <div class="title" style="float: left; margin-top: -3%; margin-right: 5%; margin-left: 33%">
                            <h3 style="margin-left: 0%;">Selecione os Sabores Desejados.</h3>
                        </div>
                        <div>
                            <button onclick="selectedFlavorsPizza(1), generateGraficPizza(1), valTotalPizza(1)" type="button" data-dismiss="modal" class="btn btn-success" style="margin-top: -1.5%; float: right; margin-right: 5%">Confirma Sabores</button>
                        </div>
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th></th>
                                    <th>Imagen</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 0 ?>
                                @foreach($flavors as $flavor)
                                <tr style="cursor: pointer">
                                    <td>{{ $flavor->id }}</td>
                                    <td>                                        
                                        <input name="pizza[1][flavorTeste][{{ $cont }}]" type="number" id="flavorNumberPizza_1" flavorId="{{ $flavor->id }}" flavor="{{ $flavor->name }}" price="{{ $flavor->price }}" description="{{ $flavor->description }}" class="form-control" style="width:60px">
                                    </td>
                                    <td>
                                        <img id="imgFlavor" class="img-rounded img-responsive" src="{{ url('uploads/'.$flavor->images->lists('id')->first().'.'.$flavor->images->lists('extension')->first()) }}" width="80">
                                    </td>
                                    <td>{{ $flavor->name }}</td>
                                    <td>{{ $flavor->description }}</td>
                                    <td>R$ {{ $flavor->price }}</td>
                                </tr>
                                <?php $cont++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                    <button onclick="selectedFlavorsPizza(1), generateGraficPizza(1), valTotalPizza(1)" type="button" data-dismiss="modal" class="btn btn-success">Confirma Sabores</button>
                </div>
            </div>
        </div>
    </div>
</div>
