<x-layout titulo="Consultar">

    <div class="container" style="margin:0 auto;">

        <!-- Formulário -->
        <form method="GET" action="/consultar" style="margin-bottom: 80px; display:flex; gap:10px; justify-content:center;">
            <input type="text" name="busca"placeholder="Digite o nome da receita..."value="<?php echo $busca ?? ''; ?>"style="width:300px; padding:8px;">
            <button type="submit" class="btn btn-primary" style="padding:8px 20px;">Buscar</button>
        </form>

        <!-- Caso não encontre nada -->
        <?php 
            if (isset($busca) && count($resultados) === 0) {
                echo "<p style='text-align:center;'>Nenhuma receita encontrada para: <strong>$busca</strong></p>";
            }
        ?>

        <!-- Listagem das receitas -->
        <?php foreach ($resultados as $item): ?>

            <?php
                $qtd = json_decode($item->quantidade);
                $med = json_decode($item->medidas);
                $ing = json_decode($item->ingredientes);
            ?>

            <div style="border:1px solid #ccc;padding:20px;margin:20px auto;background:#ffffff;max-width: 1000px;box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                <h3 style="margin-bottom:5px;"><?php echo $item->receita; ?></h3>
                <hr>

                <h4>Ingredientes</h4>
                <ul>
                    <?php for ($i = 0; $i < count($ing); $i++): ?>
                        <li>
                            <strong><?php echo $qtd[$i] ?? ''; ?></strong> 
                            <?php echo $med[$i] ?? ''; ?> —
                            <?php echo $ing[$i] ?? ''; ?>
                        </li>
                    <?php endfor; ?>
                </ul>

                <h4>Modo de Preparo</h4>
                <p><?php echo $item->preparo; ?></p>
            </div>

        <?php endforeach; ?>

    </div>

</x-layout>
