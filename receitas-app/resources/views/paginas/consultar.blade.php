<x-layout titulo="Consultar">

<div class="container" style="margin:0 auto; max-width:1100px;">

    <!-- Formulário de Busca -->
    <form method="GET" action="/consultar" style="margin-bottom: 40px; display:flex; gap:10px; justify-content:center;">
        <input type="text" name="busca" placeholder="Digite o nome da receita..."
               value="<?php echo $busca ?? ''; ?>"
               style="width:350px; padding:8px;">
        <button type="submit" class="btn btn-primary" style="padding:8px 20px;">Buscar</button>
    </form>

      <!-- Mensagem de Sucesso -->
    <?php if(session('sucesso')): ?>
        <p style="text-align:center; color:green; margin-bottom:20px;">
            <?php echo session('sucesso'); ?>
        </p>
    <?php endif; ?>
    
    <!-- Mensagem quando não encontra nada -->
    <?php if(isset($mensagem)): ?>
        <p style="text-align:center;"><?php echo $mensagem; ?></p>
    <?php endif; ?>


    <?php foreach($resultados as $id): ?>

        <?php
            $qtd = json_decode($id->quantidade) ?? [];
            $med = json_decode($id->medidas) ?? [];
            $ing = json_decode($id->ingredientes) ?? [];
            $len = max(count($qtd), count($med), count($ing));
        ?>

        <div id="card-<?php echo $id->id; ?>"style="border:1px solid #ccc; padding:20px; margin:20px auto; background:#ffffff; max-width:1000px; box-shadow:0 2px 8px rgba(0,0,0,0.12);">

            <!-- visualização -->
            <div id="view-<?php echo $id->id; ?>">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                    <h3 style="margin:0;"><?php echo $id->receita; ?></h3>

                    <a class="btn btn-primary"onclick="abrirEdicao(<?php echo $id->id; ?>)"id="editarBtn-<?php echo $id->id; ?>"style="padding:8px 16px;">Editar</a>
                </div>

                <hr>

                <h4>Ingredientes</h4>
                <ul style="list-style:none; padding-left:0; line-height:1.7;">
                    <?php for($i = 0; $i < $len; $i++): ?>
                        <li>
                            <?php 
                                if(isset($qtd[$i]) && $qtd[$i] !== '') echo "<strong>{$qtd[$i]}</strong> ";
                                if(isset($med[$i]) && $med[$i] !== '') echo $med[$i] . " ";
                                if(isset($ing[$i]) && $ing[$i] !== '') echo "- " . $ing[$i];
                            ?>
                        </li>
                    <?php endfor; ?>
                </ul>

                <h4>Modo de Preparo</h4>
                <p style="white-space:pre-wrap;"><?php echo $id->preparo; ?></p>
            </div>

            <!-- editar -->
            <div id="edit-<?php echo $id->id; ?>" style="display:none; margin-top:10px;">

                <form action="/atualizar/<?php echo $id->id; ?>" method="POST" style="display:flex; flex-direction:column; gap:10px;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <label><strong>Nome da receita</strong></label>
                    <input type="text" name="receita"
                           value="<?php echo $id->receita; ?>"
                           class="form-control" style="padding:8px;">

                    <label><strong>Ingredientes (uma linha por ingrediente - quantidade medida - ingrediente)</strong></label>
                    <textarea name="ingredientes" class="form-control" rows="6" style="padding:8px; white-space:pre-wrap;"><?php
                        for($i = 0; $i < $len; $i++){
                            echo trim(($qtd[$i] ?? '') . ' ' . ($med[$i] ?? '') . ' - ' . ($ing[$i] ?? ''));
                            if($i < $len - 1) echo "\n";
                        }
                    ?></textarea>

                    <label><strong>Modo de Preparo</strong></label>
                    <textarea name="preparo" class="form-control" rows="6" style="padding:8px;"><?php echo $id->preparo; ?></textarea>

                    <div style="display:flex; gap:10px; margin-top:6px;">
                        <button type="submit" class="btn btn-success" style="padding:8px 14px;">
                            Confirmar alteração
                        </button>

                        <a href="/excluir/<?php echo $id->id; ?>" class="btn btn-danger" style="padding:8px 14px;"onclick="return confirm('Tem certeza que deseja excluir esta receita?');">Excluir</a>

                        <a class="btn btn-secondary" style="padding:8px 14px;"onclick="fecharEdicao(<?php echo $id->id; ?>)">Cancelar</a>
                    </div>
                </form>

            </div>

        </div>

    <?php endforeach; ?>

</div>

</x-layout>


<script>
function abrirEdicao(id) {
    let view = document.getElementById('view-' + id);
    let edit = document.getElementById('edit-' + id);
    let btn = document.getElementById('editarBtn-' + id);

    view.style.display = 'none';
    edit.style.display = 'block';
    btn.style.display = 'none';

    document.getElementById('card-' + id).scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    });
}

function fecharEdicao(id) {
    let view = document.getElementById('view-' + id);
    let edit = document.getElementById('edit-' + id);
    let btn = document.getElementById('editarBtn-' + id);

    view.style.display = 'block';
    edit.style.display = 'none';
    btn.style.display = 'inline-block';
}
</script>
