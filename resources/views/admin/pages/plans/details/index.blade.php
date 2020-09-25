@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
    </ol>

    <h1>Detalhes do plano {{ $plan->name }} <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-dark">Cadastrar</a></h1>
@stop

@section('content')
    <p>Listagem dos Planos.</p>
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="100">Acões</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>
                                {{ $detail->name }}
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}">Edit</a>
                                <a class="btn btn-warning" href="{{ route('details.plan.show', [$plan->url, $detail->id]) }}">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filter))
                {{ $details->appends($filter)->links() }}
            @else
                {{ $details->links() }}
            @endif
        </div>
    </div>
@stop
