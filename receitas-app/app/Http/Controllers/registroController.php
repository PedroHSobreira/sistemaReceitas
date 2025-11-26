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
         
        }//fim do consuktar

    }//fim da classe