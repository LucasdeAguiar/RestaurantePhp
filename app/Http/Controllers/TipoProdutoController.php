<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\DB;

class TipoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * Mostra uma lista com todos os recursos cadastrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
                 $tipoProdutos = DB::select('SELECT * FROM TIPO_PRODUTOS');
        }catch(\Throwable $th){
            return view("TipoProduto/index")->with("tipoProdutos", [])->with("message", [$th->getMessage(), "danger"]);
        }
        
        return view("TipoProduto/index")->with("tipoProdutos", $tipoProdutos);
    }

    public function indexMessage($message)
    {
        try {
            $tipoProdutos = DB::select('SELECT * FROM TIPO_PRODUTOS');
        } catch (\Throwable $th) {
            return view("TipoProduto/index")->with("tipoProdutos", [])->with("message", [$th->getMessage(), "danger"]);
        }
        return view("TipoProduto/index")->with("tipoProdutos", $tipoProdutos)->with("message", $message);
    }

    /**
     * Show the form for creating a new resource.
     * Mostrar um formulário para criação de um novo recurso
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{

             return view("TipoProduto/create");

        }catch (\Throwable $th) {
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }

        return view("TipoProduto/create");
    }

    /**
     * Store a newly created resource in storage.
     * Armazena um recurso recém criado na base de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoProduto = TipoProduto();
        $tipoProduto->descricao = $request->descricao;
        $tipoProduto->save();
        return $this->index();
    }

    /**
     * Display the specified resource.
     * Mostra um recurso específico em detalhes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $tipoProdutos = DB::select('SELECT * FROM TIPO_PRODUTOS');

            if(count($produtos) > 0) {
               
                return view("TipoProduto/show")->with("tipoProduto", $tipoProdutos[0]);
            }
        
            return $this->indexMessage( ["Tipo do Produto não encontrado", "warning"] );
        } catch (\Throwable $th) {
            return view("TipoProduto/index")->with("tipoProdutos", [])->with("message", [$th->getMessage(), "danger"]);
        }
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $tipoProduto = TipoProduto::find($id); // retorna um obj ou null
            // Pergunto se o obj é válido ou null
            if( isset($tipoProduto) ){
                // Array com todos os TipoProdutos no BD
                $tipoProdutos = TipoProduto::all();
                // Retorno quando dá certo
                return view("TipoProduto/edit")
                            ->with("tipoProduto", $tipoProduto);
                 
            }
            // Retorno de aviso, produto não encontrado
            return $this->indexMessage( ["Tipo Produto não encontrado", "warning"] );
        } catch (\Throwable $th) {
            // Retorno quando dá erro
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //echo "Tipo $request->Tipo_Produtos_id";
            $tipoProduto = TipoProduto::find($id); // retorna um obj ou null
            // Dentro dessa variável eu já tenho o produto que eu quero atualizar

            // Pergunto se o obj é válido ou null (se ele existe)
            if( isset($tipoProduto) ){
                $tipoProduto->descricao = $request->descricao;
              
              
                $tipoProduto->update();
                // Recarregar a view index.
                // return \Redirect::route('produto.index');
                // Retorno quando dá certo
                return $this->indexMessage( ["Tipo Produto atualizado com sucesso", "success"] );
            }
            // Retorno de aviso, produto não encontrado
            return $this->indexMessage( ["Tipo Produto não encontrado", "warning"] );
        } catch (\Throwable $th) {
            // Retorno quando dá erro
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tipoProduto = TipoProduto::find($id); // Retorna o objeto encontrado ou null, caso ñ encontrado
            // Se o produto foi encontrado
            if( isset($tipoProduto) ) {
                $tipoProduto->delete();
                // return \Redirect::route('produto.index');
                // Retorno quando dá certo
                return $this->indexMessage( ["Tipo Produto removido com sucesso", "success"] );
            }
            // Retorno de aviso, produto não encontrado
            return $this->indexMessage( ["Tipo Produto não encontrado", "warning"] );
        } catch (\Throwable $th) {
            // Retorno quando dá erro
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }
    }
    
}
