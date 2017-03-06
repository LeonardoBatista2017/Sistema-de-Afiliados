<?php

namespace App\Http\Controllers\Painel;

use App\Models\PostContadorCodigo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PostContadorCodigoController extends Controller {

    private $postContadorCodigo;
    protected $route = 'posts-gerar-url';

    public function __construct(PostContadorCodigo $postContadorCodigo) {
        $this->postContadorCodigo = $postContadorCodigo;
    }

    public function store($id) {

        $user_id = Auth::user()->id;



        $contadores = DB::table('contador_registro')
                ->join('users', 'users.id', '=', 'contador_registro.user_id')
                ->select('contador_registro.codigo as codigo', 'contador_registro.id as id')
                ->where('user_id', $user_id)
                ->first();

        $postContadorCodigo = DB::table('post_contador_codigo')
                ->join('posts', 'posts.id', '=', 'post_contador_codigo.post_id')
                ->join('contador_registro', 'contador_registro.id', '=', 'post_contador_codigo.contador_id')
                ->select('contador_registro.codigo as codigo', 'post_contador_codigo.contador as contador', 'post_contador_codigo.id as id', 'posts.url as url', 'posts.description as description', 'post_contador_codigo.post_id as post_id')
                ->where('contador_registro.user_id', $user_id)
                ->get();

        $postContadorCodigo1 = DB::table('post_contador_codigo')
                ->join('posts', 'posts.id', '=', 'post_contador_codigo.post_id')
                ->join('contador_registro', 'contador_registro.id', '=', 'post_contador_codigo.contador_id')
                ->select('contador_registro.codigo as codigo', 'post_contador_codigo.contador as contador', 'post_contador_codigo.id as id', 'posts.url as url', 'posts.description as description', 'post_contador_codigo.post_id as post_id')
                ->where('post_contador_codigo.post_id', $id)
                ->where('contador_registro.user_id', $user_id)
                ->first();



        if ($contadores != Null){
            if($postContadorCodigo1==Null) {
                    $postContadorCodigo = new PostContadorCodigo();
                    $postContadorCodigo->contador_id = $contadores->id;
                    $postContadorCodigo->post_id = $id;
                    $postContadorCodigo->save();
            }
        
                     
                    
        } else {
            return redirect()
                            ->route("usuarios.store")
                            ->withErrors(['errors' => 'Favor Completar o Seu Cadastro'])
                            ->withInput();
        }
    }

}
