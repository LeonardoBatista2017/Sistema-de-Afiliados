<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class StandardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $totalPage = 10;    
    protected $upload = false;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
         $user_id = Auth::user()->id;
         $postContadorCodigo=DB::table('post_contador_codigo')
            ->join('posts','posts.id','=','post_contador_codigo.post_id')
            ->join('contador_registro','contador_registro.id','=','post_contador_codigo.contador_id')
            ->select('contador_registro.codigo as codigo','post_contador_codigo.contador as contador','post_contador_codigo.id as id','posts.url as url','posts.description as description','posts.image as image')
            ->where('contador_registro.user_id',$user_id)
            ->get();
        
        $title = "Listagem {$this->name}s";
        
        $data = $this->model->paginate($this->totalPage);
       
        if(Auth::user()->id==16){
            return view("{$this->view}.index-admin", compact('title', 'data','postContadorCodigo'));
        }else{
        return view("{$this->view}.index", compact('title', 'data','postContadorCodigo'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar {$this->name}";
        
        return view("{$this->view}.create-edit", compact('title'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->find($id);
        
        $title = "{$this->name}: {$data->name}";
        
        return view("{$this->view}.show", compact('data', 'title'));
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
        
        $title = "Editar {$this->name}: {$data->name}";
        
        return view("{$this->view}.create-edit", compact('data', 'title'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id);
        
        $delete = $data->delete();
        
        if( $delete )
            return redirect()
                        ->route("{$this->route}.index")
                        ->with(['success' => "<b>{$data->name}</b> excluído com sucesso!"]);
        else
            return redirect()->route("{$this->route}.edit", ['id' => $id])
                                        ->withErrors(['errors' => 'Falha ao excluír!']);
    }
    
    
    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->except('_token');
        
        //Filtra os dados
        $data = $this->model
                    ->where('name', 'LIKE', "%{$dataForm['key-search']}%")
                    ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('data', 'dataForm'));
    }
}