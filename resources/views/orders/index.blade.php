@extends('app')
@section('content')

<div class="col-md-12">

    <h3 style="float: left">Pedidos</h3>
    <div style="float: right; margin-top: 1%">                
        <a href="{{ route('order.create') }}" class="btn btn-default">Novo Pedido</a>        
    </div>            

    <br><br>

    <table class="table table-hover table-condensed">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>N° Pedido</th>
                <th>Form. Entrega</th>
                <th>Status</th>
                <th>Data</th>
                <th>Entregador</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $cont = 1;
                $color = 'warning';
            ?>
            @foreach($orders as $order)
            
            @if($order->deliverie()->where('order_id', $order->id)->first())
                <?php $color = ''; ?>
            @else
                <?php $color = 'warning'; ?>
            @endif
            
            <tr class="{{ $color }}">
                <td>{{ $cont++ }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->deliveryMean->name }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    @if(isset($order->deliverie->id))
                       {{ $order->deliverie->user->name }}
                    @endif
                </td>
                <td>{{ $order->total }}</td>
                <td>
                    <a href="{{ route('order.show', ['id'=>$order->id]) }}" class="btn btn-default btn-sm">
                        Vizualizar Detalhes
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        Cancelar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    

    {!! $orders->render() !!}

</div>

@endsection