@include('admin.includes.alerts')

<div class="form-group">
    <label for="Nome:"></label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $plan->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="Preco:"></label>
    <input type="text" name="price" class="form-control" placeholder="Preco:" value="{{ $plan->price ?? old('price') }}">
</div>
<div class="form-group">
    <label for="Descricão:"></label>
    <input type="text" name="description" class="form-control" placeholder="Descricão:" value="{{ $plan->description ?? old('description') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
