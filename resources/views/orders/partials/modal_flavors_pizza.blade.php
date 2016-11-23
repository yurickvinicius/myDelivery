<div class="view">
    <div class="modal fade" id="modal_cad_flavors_pizza_1">
        <div style="width: 90%; margin-left: auto; margin-right: auto; margin-top: 3%">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group" style="margin-top: 1%">
                        
                        <div class="title f_left">
                            <h4><span id="spanMaxPiecesPizza_1"><b>Atenção:</b> Necessário escolher o tamanho da pizza!</span></h4>
                        </div>
                        <div class="f_right">
                            <button onclick="selectedFlavorsPizza(1), generateGraficPizza(1), valTotalPizza(1)" type="button" data-dismiss="modal" class="btn btn-success">Confirma Sabores</button>
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
                                        <input onchange="checkPizza({{ $flavor->id }}, 1)" name="pizza[1][flavor][{{ $flavor->id }}]" type="number" min="0" max="20" id="flavorNumberPizza_1" flavorId="{{ $flavor->id }}" flavor="{{ $flavor->name }}" price="{{ $flavor->price }}" description="{{ $flavor->description }}" class="form-control" style="width:60px">
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
