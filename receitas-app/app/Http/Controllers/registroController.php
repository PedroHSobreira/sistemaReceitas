<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\registroModel;

class registroController extends Controller
{
    public function paginaInicial(){
        return view('paginas.index');
    }//fim da paginaInicial

    public function cad(){
        return view('paginas.cadastrar');
    }//fim do metodo que direciona para pagina inicial

    public function inserir(Request $request){

        $receita = $request->input('receita');//Coletando nome da receita
        $preparo = $request->input('preparo');//Coletando modo de preparo


        //coleta dos campos dinamicos
        $quantidade     = $request->input('quantidade', []);
        $medidas        = $request->input('medidas', []);
        $ingredientes   = $request->input('ingredientes', []);
        
       
        //chamar a model = vai inserir os dados no banco
        $model = new registroModel();
        $model->receita         = $receita;
        $model->quantidade      = json_encode($quantidade);
        $model->medidas         = json_encode($medidas);
        $model->ingredientes    = json_encode($ingredientes);
        $model->preparo         = $preparo;
        //Efetivar a inserçao no banco
        $model->save();
        //Depois de cadastrar permanece na pagina vazia ou vai para outra pagina
        return redirect('/cadastrar');
    }//fim do metodo inserir

    public function consultar(Request $request){
        //pegar o texto digitado na busca
        $busca = $request->input('busca');

        //se o usuario buscar, filtra
        if($busca) {
            $resultados = registroModel::where('receita','like', "%$busca%")->get();
            
            if ($resultados->isEmpty()){
                $mensagem = "Nenhuma receita encontrada para: $busca";
            } else {
                $mensagem = null;
            }
        } else{
            $resultados = [];
            
        }

        return view('paginas.consultar', compact('resultados','busca'));
        }//fim do consultar

        public function atualizar(Request $request, $id)
        {
            $receita = registroModel::findOrFail($id);

            $receita->receita = $request->input('receita');
            $receita->preparo = $request->input('preparo');

            $linhas = preg_split('/\r\n/', trim($request->input('ingredientes')));

            $qtd = [];
            $med = [];
            $ing = [];

            foreach ($linhas as $linha) {

                // Remove espaços extras
                $linha = trim($linha);
                if ($linha === "") continue;

                $partes = explode('-', $linha, 2);

                $esquerda = trim($partes[0] ?? '');
                $direita  = trim($partes[1] ?? '');

                $esqPartes = explode(' ', $esquerda, 2);

                $qtd[] = $esqPartes[0] ?? '';
                $med[] = $esqPartes[1] ?? '';
                $ing[] = $direita;
            }

        $receita->quantidade   = json_encode($qtd);
        $receita->medidas      = json_encode($med);
        $receita->ingredientes = json_encode($ing);

        $receita->save();
        return redirect('/consultar')->with('sucesso', 'Receita atualizada com sucesso!');
    }

    public function excluir($id)
    {
        $receita = registroModel::findOrFail($id);

        $receita->delete();

        return redirect('/consultar')->with('sucesso', 'Receita excluída com sucesso!');

    }

    }//fim da classe