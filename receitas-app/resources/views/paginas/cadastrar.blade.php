<x-layout titulo="cadastrar">
    <form class="container" action="cadastrar/salvar" method="GET"> 
        @csrf
         <div class="mb3">
            <label class="form-label">Nome da Receita</label>
            <input type="text" name="receita" class="form-control" id="receita"/>
        </div>

        <div class="mb3">
            <label class="form-label">Quantidade</label>
            <input type="text" name="quantidade" class="form-control" id="quantidade"/>
        </div>

        <div class="mb3">
            <label class="form-label">Medidas</label>
            <input type="text" name="medidas" class="form-control" id="medidas"/>
        </div>

        <div class="mb3">
            <label class="form-label">Ingredientes</label>
            <input type="text" name="ingredientes" class="form-control" id="ingredientes"/>
        </div>

        <div class="mb3">
            <label class="form-label">Modo de Preparo</label>
            <textArea name="preparo" class="form-control" id="preparo"/></textArea>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a class="btn btn-primary" href="consultar">Voltar</a>

    </form>
</x-layout>