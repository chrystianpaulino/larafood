@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Planos</li>
    </ol>

    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-dark">Cadastrar</a></h1>
@stop

@section('content')
    <p>Listagem dos Planos.</p>
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome do Plano" class="form-control" value="{{ $filter['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Preco</th>
                        <th width="100">Acões</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td>
                                {{ $plan->name }}
                            </td>
                            <td>
                                R$ {{ number_format($plan->price, 2, ',', '.') }}
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('plans.edit', $plan->url) }}">Edit</a>
                                <a class="btn btn-warning" href="{{ route('plans.show', $plan->url) }}">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filter))
                {{ $plans->appends($filter)->links() }}
            @else
                {{ $plans->links() }}
            @endif
        </div>
    </div>
@stop
