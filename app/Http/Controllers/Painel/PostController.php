<?php
namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Post;
use App\Models\PostContadorCodigo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class PostController extends StandardController
{
    protected $model;
    protected $name     = 'Post';
    protected $view     = 'painel.posts';
    protected $route    = 'posts';
    protected $upload   = ['name' => 'image', 'path' => 'posts'];

    public function __construct(Post $post)
    {
        $this->model = $post;
    }
    
    
   public function index()
    {
        
         $postContadorCodigo=Post::with('viewsContadorCodigo')->get();
                
        $title = "Listagem {$this->name}s";
       
        
   
        if(Auth::user()->id==16){
            return view("{$this->view}.index-admin", compact('title', 'data','postContadorCodigo'));
        }else{
        return view("{$this->view}.index", compact('title','postContadorCodigo'));
        }
    }
    
 
    public function create()
    {
        $title = "Cadastrar {$this->name}";
        
        $categories = Category::get()->pluck('name', 'id');
        
        return view("{$this->view}.create-edit", compact('title', 'categories'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valida os dados
        $this->validate($request, $this->model->rules());
        
        //Pega todos os dados do formulário
        $dataForm = $request->all();
        
        $dataForm['featured'] = isset( $dataForm['featured'] ) ? true : false;
        
        $dataForm['user_id'] = auth()->user()->id;
        
        //Verifica se existe a imagem
        if( $this->upload && $request->hasFile($this->upload['name']) ) {
            //Pega o arquivo
            $image = $request->file($this->upload['name']);
            
            //Define o nome para o arquivo
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
            
            $upload = $image->storeAs($this->upload['path'], $nameFile);
            
            if( $upload ) 
                $dataForm[$this->upload['name']] = $nameFile;
            else
                return redirect()
                            ->route("{$this->route}.create")
                            ->withErrors(['errors' => 'Erro no Upload'])
                            ->withInput();
        }
        
        //Insere os dados
        $insert = $this->model->create($dataForm);
        
        if( $insert )
            return redirect()
                        ->route("{$this->route}.index")
                        ->with(['success' => 'Cadastro realizado com sucesso!']);
        else
            return redirect()
                            ->route("{$this->route}.create")
                            ->withErrors(['errors' => 'Falha ao cadastrar!'])
                            ->withInput();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);
        
        $title = "Editar {$this->name}: {$data->title}";
        
        $categories = Category::get()->pluck('name', 'id');
        
        return view("{$this->view}.create-edit", compact('data', 'title', 'categories'));
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
        //Valida os dados
        $this->validate($request, $this->model->rules($id));
        
        //Pega todos os dados do formulário
        $dataForm = $request->all();
        
        //Cria o objeto da model
        $data = $this->model->find($id);
        
        $dataForm['featured'] = isset( $dataForm['featured'] ) ? true : false;
        
        //Verifica se existe a imagem
        if( $this->upload && $request->hasFile($this->upload['name']) ) {
            //Pega o arquivo
            $image = $request->file($this->upload['name']);
            
            //Verifica se o nome do arquivo não existe
            if( $data->image == '' ){
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataForm[$this->upload['name']] = $nameImage;
            }else {
                $nameImage = $data->image;
                $dataForm[$this->upload['name']] = $data->image;
            }
            
            $upload = $image->storeAs($this->upload['path'], $nameImage);
            
            if( $upload )
                $dataForm[$this->upload['name']] = $nameImage;
            else
                return redirect()
                            ->route("{$this->route}.edit", ['id' => $id])
                            ->withErrors(['errors' => 'Erro no Upload'])
                            ->withInput();
        }
        
        //Altera os dados
        $update = $data->update($dataForm);
        
        if( $update )
            return redirect()
                        ->route("{$this->route}.index")
                        ->with(['success' => 'Alteração realizada com sucesso!']);
        else
            return redirect()
                        ->route("{$this->route}.edit", ['id' => $id])
                        ->withErrors(['errors' => 'Falha ao editar'])
                        ->withInput();
    }
    
    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->except('_token');
        
        //Filtra os dados
        $data = $this->model
                    ->where('title', 'LIKE', "%{$dataForm['key-search']}%")
                    ->orWhere('description', 'LIKE', "%{$dataForm['key-search']}%")
                    ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('data', 'dataForm'));
    }
}