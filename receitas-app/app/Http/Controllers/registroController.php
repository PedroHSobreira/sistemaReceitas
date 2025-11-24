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
        $quantidade = $request->input('quantidade');//Coletando quantidade 
        $medidas = $request->input('medidas');//Coletando medidas
        $ingredientes = $request->input('ingredientes');//Coletando ingredientes
        $preparo = $request->input('preparo');//Coletando modo de preparo
        //chamar a model = vai inserir os dados no banco
        $model = new registroModel();
        $model->receita         = $receita;
        $model->quantidade      = $quantidade;
        $model->medidas         = $medidas;
        $model->ingredientes    = $ingredientes;
        $model->preparo         = $preparo;
        //Efetivar a inserçao no banco
        $model->save();
        //Depois de cadastrar permanece na pagina vazia ou vai para outra pagina
        return redirect('/cadastrar');
    }//fim do metodo inserir




    
    }//fim da classe