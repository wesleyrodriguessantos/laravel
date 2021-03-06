@extends('admin.layouts.app')

@section('title', 'Listando Produtos')

@section('content')
    <h1>Exibindo os produtos</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Cadastrar</a>

    <hr>

    <form action="{{ route('products.search') }}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
        <button type="submit" class="btn btn-info">Pesquisar</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th width="100">Imagem</th>
                <th>Nome</th>
                <th>Preço</th>
                <th width="100">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name }}" style="max-width: 100px;">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">Editar</a>
                        <a href="{{ route('products.show', $product->id) }}">Detalhes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {!! $products->links() !!} --}}
    @if (isset($filters))
        {!! $products->appends($filters)->links() !!}
    @else
        {!! $products->links() !!}
    @endif

@endsection
    {{-- @component('admin.components.card')
        @slot('title')
            <h1>Título Card</h1>
        @endslot
        Um card de exemplo
    @endcomponent

    <hr>

    @include('admin.includes.alerts', ['content' => 'Alerta de preços de produtos'])
   
    <hr>

    @if (isset($products))
        {{-- foreach -> Para cada 
        @foreach ($products as $product)
            <p class="@if ($loop->last) last @endif">{{ $product }}</p>
        @endforeach
    @endif

    <hr>
    {{-- forelse -> Faz uma verificação semelhante a do foreach, porém já apresenta um retorno em cado de array/variável vazia
    @forelse ($products as $product)
        <p class="@if ($loop->first) last @endif">{{ $product }}</p>
    @empty
        <p>Não existem produtos cadastrados.</p>
    @endforelse
    <hr>

    {{-- If e Else 
    @if ($teste === '123')
        É igual
    @elseif($teste == 123)
        É igual a 123
    @else
        É diferente
    @endif

    {{-- "Um if "Ao contrário" 
    @unless ($teste === '123')
        dsfdsfs
    @else
        dsfsdfsd
    @endunless

    {{-- Verifica se uma variável existe 
    @isset($teste2)
        <p>{{ $teste2 }}</p>
    @endisset

    {{-- Verifica se está vazio 
    @empty($teste3)
        <p>Vazio...</p>
    @endempty

    {{-- ´Para verificar se está autenticado 
    @auth
        <p>Autenticado</p>
    @else
        <p>Não autenticado</p>
    @endauth

    {{-- Inverso do Auth, verifica se não está autenticado 
    @guest
        <p>Não autenticado</p>
    @endguest

    {{-- O famoso switch case 
    @switch($teste)
        @case(1)
            Igual 1
            @break
        @case(2)
            Igual 2
            @break
        @case(3)
            Igual 3
            @break
        @case(123)
            Igual 123
            @break
        @default
            Default
    @endswitch

@endsection

@push('styles')
    <style>
        .last {background: #CCC;}
    </style>
@endpush

@push('scripts')
    <script>
        document.body.style.background = '#efefef'
    </script>
@endpush  --}}