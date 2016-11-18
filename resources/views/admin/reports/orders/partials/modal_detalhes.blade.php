<div class="modal fade" id="modal_detalhes_<?= $report->id ?>">
  <div class="modal-dialog" style="width: 90%; margin-left: auto; margin-right: auto; margin-top: 3%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detalhes do Pedido {{ $report->id }}</h4>
      </div>


      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title" contenteditable="true">Dados do Cliente</h3>
          </div>
          <div class="panel-body" contenteditable="true">
              <div class="col-md-3">
                  <div>
                      <label>Data do Pedido:</label>
                      {{ $report->created_at }}
                  </div>
                  <div>
                      <label>Nome do Cliente:</label>
                      {{ $report->client->name }}
                  </div>
                  <div>
                      <label>Telefone Celular:</label>
                      {{ $report->client->cell_phone }}
                  </div>
                  <div>
                      <label>Telefone Fixo:</label>
                      {{ $report->client->phone }}
                  </div>
              </div>
              <div class="col-md-5">
                  <div>
                      <label>Bairro:</label>
                      {{ $report->client->neighborhood }}
                  </div>
                  <div>
                      <label>Endereço do Cliente:</label>
                      {{ $report->client->address }}
                  </div>
                  <div>
                      <label>Numero:</label>
                      {{ $report->client->number }}
                  </div>
                  <div>
                      <label>Complemento:</label>
                      {{ $report->client->complement }}
                  </div>
              </div>
              <div class="col-md-4">
                  <div>
                      <label>Meio de Entrega:</label>
                      {{ $report->deliveryMean->name }}
                      <b>Valor: </b> R$ {{ $report->deliveryMean->price }}
                  </div>

                  @if($report->deliverie != '')
                      <div>
                         <label>Entregador:</label> {{ $report->deliverie->user->name }}
                      </div>
                  @endif

                  <div>
                      <label>Forma de Pagamento:</label>
                      {{ $report->paymentForm->form }}
                  </div>

                  <div>
                      <label>Troco para pagamento:</label>
                      R$ {{ $report->paymentForm->exchange_money }}
                  </div>

                  <div>
                      <label>Total:</label>
                      {{ $report->total }}
                  </div>
              </div>
          </div>
      </div>


      @foreach($report->orderPizzas as $reportPizza)
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">
                  Dados da Pizza
              </h3>
          </div>

          <div class="panel-body">
              <div>
                  <div class="col-md-3">
                      <div>
                          <label>Tamanho:</label>
                          {{ $reportPizza->pizzaBuilts->find($reportPizza->pizza_built_id)->sizePizza->size }}
                      </div>
                      <div>
                          <label>Preço da Pizza:</label>
                          R$ {{ $reportPizza->pizzaBuilts->find($reportPizza->pizza_built_id)->sizePizza->price }}
                      </div>
                      <div>
                          <label>Borda:</label>
                          {{ $reportPizza->pizzaBuilts->find($reportPizza->pizza_built_id)->edgePizza->name }}
                          <b>Valor</b>: R$ {{ $reportPizza->pizzaBuilts->find($reportPizza->pizza_built_id)->edgePizza->price }}
                      </div>
                  </div>

                  <div class="col-md-9">
                    <label>Sabores: </label>
                    <div>
                        <?php $cont=1 ?>
                        @foreach($reportPizza->pizzaBuilts->find($reportPizza->pizza_built_id)->flavorsPizza as $flavoPizza)
                            {{ $cont++ }} - {{ $flavoPizza->flavor->name }} -
                            {{ $flavoPizza->flavor->description }} -
                            <span style="float:right">R$ {{ $flavoPizza->flavor->price }} </span><br>
                        @endforeach
                    </div>
                  </div>
                  <div class="col-md-12">
                      <label>Observação:</label>
                      {{ $reportPizza->pizzaBuilts->find($reportPizza->pizza_built_id)->observation }}
                  </div>

              </div>
          </div>
      </div>
      @endforeach


      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title" contenteditable="true">
                  Opcionais
              </h3>
          </div>
          <div class="panel-body" contenteditable="true">

              @if(count($report->orderDrinks) == 0)
                  <div class="col-md-6">Nenhum</div>
              @endif

              @foreach($report->orderDrinks as $reportDrinks)
              <div class="col-md-6">
                  <label>Bebida:</label>
                  <?php $drink = $reportDrinks->find($reportDrinks->id)->drinks ?>
                  <?= $drink[0]['name'] ?>
                  <b>Valor:</b> R$ <?= $drink[0]['price'] ?>
              </div>
              @endforeach
          </div>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
