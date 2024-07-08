@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Criar Novo Evento</h1>
    <div class="card p-4 shadow-sm">
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="event_date" class="form-label">Data do Evento:</label>
                    <input type="datetime-local" name="event_date" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="responsible" class="form-label">Responsável:</label>
                    <input type="text" name="responsible" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="cep" class="form-label">CEP:</label>
                    <input type="text" name="cep" id="cep" class="form-control" pattern="\d{5}-\d{3}" title="Formato: 00000-000">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="city" class="form-label">Cidade:</label>
                    <input type="text" name="city" id="city" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="state" class="form-label">Estado:</label>
                    <input type="text" name="state" id="state" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Endereço:</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="number" class="form-label">Número:</label>
                    <input type="text" name="number" class="form-control" required pattern="\d+" title="Somente números">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="complement" class="form-label">Complemento:</label>
                    <input type="text" name="complement" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Telefone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" required pattern="\(\d{2}\) \d{4,5}-\d{4}" title="Formato: (00) 00000-0000 ou (00) 0000-0000">
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagem:</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('#cep').mask('00000-000');
        $('#phone').mask('(00) 00000-0000');
    });

    document.getElementById('cep').addEventListener('blur', function() {
        const cep = this.value.replace(/\D/g, '');
        if (cep !== "") {
            const validacep = /^[0-9]{8}$/;
            if(validacep.test(cep)) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('address').value = data.logradouro;
                            document.getElementById('city').value = data.localidade;
                            document.getElementById('state').value = data.uf;
                        } else {
                            alert("CEP não encontrado.");
                        }
                    })
                    .catch(error => console.error('Erro ao buscar o CEP:', error));
            } else {
                alert("Formato de CEP inválido.");
            }
        }
    });
</script>
@endsection
