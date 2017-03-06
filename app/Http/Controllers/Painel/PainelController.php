<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\PostContadorCodigo;
use App\User;
class PainelController extends Controller
{
    
    protected $view     = 'painel.posts';
    private $postContadorCodigo;
 
    
    public function __construct(PostContadorCodigo $postContadorCodigo) {
        $this->postContadorCodigo = $postContadorCodigo;
    }
    
    
    
    public function index()
    {
        $users=User::get();
        
        if(Auth::user()->id==16){
            return view('painel.home.index-admin',compact('users'));
        }else{
             return view('painel.home.index');
        }
       
        
    }
    
    //painel do administrador 
     public function indexAdmin()
    {
        
    }
    public function ganhos()
    {
        if (Auth::user()->id) {
            $id=Auth::user()->id;
            $contadores=DB::table('contador_registro')
                    ->join('users','users.id','=','contador_registro.user_id')
                    ->select('contador_registro.codigo as codigo','contador_registro.contador as contador')
                    ->where('user_id',$id)
                    ->get();
            
             $postContadorCodigo=DB::table('post_contador_codigo')
            ->join('posts','posts.id','=','post_contador_codigo.post_id')
            ->join('contador_registro','contador_registro.id','=','post_contador_codigo.contador_id')
            ->select('contador_registro.codigo as codigo','post_contador_codigo.contador as contador','post_contador_codigo.id as id','posts.url as url','posts.description as description','posts.image as image')
            ->where('contador_registro.user_id',$id)
            ->get();
           }
           
        return view('painel.ganhos.index',compact('contadores','postContadorCodigo'));
    }
}