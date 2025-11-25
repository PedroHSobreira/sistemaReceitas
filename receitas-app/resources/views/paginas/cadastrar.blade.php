<x-layout titulo="cadastrar">
    <form class="container" action="cadastrar/salvar" method="GET" style="max-width: 900px; margin: 0 auto;">
        @csrf

        <?php
        // Quantidade total de linhas de ingredientes vindas pela URL.
        $linhas = isset($_GET['ing']) ? intval($_GET['ing']) : 1;

        // Linha que o usuário solicitou remover (se houver).
        $remove = isset($_GET['remove']) ? intval($_GET['remove']) : null;

        // Caso exista uma linha para remover, remove um campo
        if ($remove !== null && $remove > 0) {$linhas--;}
        ?>

        <!-- Campo para nome da receita -->
        <div class="mb3">
            <label class="form-label">Nome da Receita</label>
            <input type="text" name="receita" class="form-control" id="receita">
        </div>

        <br>

        <?php 
        // Loop para criar todos os campos de ingredientes existentes
        for ($i = 1; $i <= $linhas; $i++): 
        ?>

        <?php 
        // Se o ingrediente atual for apagado, entao ele nao aparece na página
        if ($remove !== null && $remove == $i) continue; 
        ?>

        <!-- Grupo de campos de ingrediente -->
        <div class="mb3" style="display: flex; gap: 30px;">

            <div>
                <label class="form-label">Quantidade</label>
                <input type="text" name="quantidade[]<?= $i ?>" class="form-control" style="width: 120px;">
            </div>

            <div>
                <label class="form-label">Medidas</label>
                <input type="text" name="medidas[]<?= $i ?>" class="form-control" style="width: 120px;">
            </div>

            <div style="flex: 1;">
                <label class="form-label">Ingredientes</label>
                <input type="text" name="ingredientes[]<?= $i ?>" class="form-control">
            </div>

            <!-- Botão para remover a linha atual -->
            <div style="display: flex; align-items: flex-end;">
                <a href="?ing=<?= $linhas ?>&remove=<?= $i ?>" class="btn btn-danger" style="height: 35px;">Remover</a>
            </div>
        </div>

        <?php endfor; ?>

        <br>

        <!-- Botão para adicionar uma nova linha de ingrediente -->
       <a href="?ing=<?= $linhas + 1 ?>" class="btn btn-primary">Adicionar Ingrediente</a>

        <br><br>

        <!-- Campo do modo de preparo -->
        <div class="mb3">
            <label class="form-label">Modo de Preparo</label>
            <!-- value mantém o texto digitado -->
            <textarea name="preparo" class="form-control" id="preparo"></textarea>
        </div>

        <br><br>

        <!-- Botoes salvar e Voltar-->
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a class="btn btn-primary" href="consultar">Voltar</a>
    </form>
     
</x-layout>
