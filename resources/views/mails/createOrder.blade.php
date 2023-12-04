<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Boas Vindas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="grid text-center">
        <div class="card mt-3">
            <h3 class="text-white bg-info mt-3">Resumo do seu Pedido de Número: {{ $order['numero_pedido'] ?? 0 }}</h3>
            <hr />
            <p>
                <b>Quantidade de Itens:</b> {{ $order['quantidade_item'] ?? 0 }}
            </p>
            <p>
                <b>Total Pago:</b> R${{ number_format($order['total'], 2, ',', '.') }}&nbsp;&nbsp;&nbsp;
                <b>Tipo da Entrega:</b> {{ $order['tipo_entrega'] ?? '' }}
                &nbsp;&nbsp;&nbsp;
                <b>Valor da Entrega:</b> R${{ number_format($order['valor_entrega'], 2, ',', '.') }}
            </p>
            @php
                $count = 1;
            @endphp
            <table class="table table-striped mt-3">
                <thead class="text-white bg-info">
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Preço UN</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <th scope="row">@php echo $count++; @endphp</th>
                        <td>{{ $item['nome'] ?? '' }}</td>
                        <td>R${{ number_format($item['preco'], 2, ',', '.') }}</td>
                        <td>{{ $item['quantidadeItem'] ?? 0 }}</td>
                        <td>R${{ number_format($item['subTotal'], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>
                Atenciosamente,
            </p>
            <p>
                Delivery
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
