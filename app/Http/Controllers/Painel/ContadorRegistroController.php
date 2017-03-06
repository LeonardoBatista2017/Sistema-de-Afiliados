<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;

class ContadorRegistroController extends Controller
{
    private $contador;
    protected $totalPage = 10;
  

    public function __construct(ContadorRegistro $contador )
    {
        $this->contador    = $contador;
      
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Usuários';
        
        $users = $this->user->paginate($this->totalPage);
        
        return view('painel.users.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if(Auth::user()->id == $id ){
        
         //Recupera o usuário pelo id
         $user = $this->user->find($id);
         
         
         }else{
             echo "Acesso Negado";
         }
        
        $title = "Editar Usuário: {$user->name}";
        
        return view('painel.users.create-edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Array $data)
    {
       
       
        
         
             dd('passou');
         
             //Cria o objeto de usuário
             $dados = $this->contador->find($data['codigo']);
                
                  
                  
                 //Altera os dados do usuário
                $update = $contador->update($dados);
                
       
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
           if(Auth::user()->id == $id ){
        //Recupera o usuário
        $user = $this->user->find($id);
        
        //deleta
        $delete = $user->delete();
           }else{
               echo "Acesso Negado";
           }
        if( $delete ) {
            return redirect()->route('usuarios.index');
        } else {
            return redirect()->route('usuarios.show', ['id' => $id])
                                        ->withErrors(['errors' => 'Falha ao deletar']);
        }
    }
    
    
  
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UserFormRequest $request, $id)
    {
        //Pega todos os dados do usuário
        $dataUser = $request->all();
 
        //Cria o objeto de usuário
        $user = $this->user->find($id);
        
        //Criptografa a senha
        $dataUser['password'] = bcrypt($dataUser['password']);
        
        //Remove o e-mail do usuário para não atualizar
        unset($dataUser['email']);
        
        //Verifica se existe a imagem
        if( $request->hasFile('image') ) {
            //Pega a imagem
            $image = $request->file('image');
            
            //Verifica se o nome da imagem não existe
            if( $user->image == '' ){
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataUser['image'] = $nameImage;
            }else {
                $nameImage = $user->image;
                $dataUser['image'] = $user->image;
            }
            
            $upload = $image->storeAs('users', $nameImage);
            
            if( !$upload ) 
                return redirect()->route('profile')
                                            ->withErrors(['errors' => 'Erro no Upload'])
                                            ->withInput();
        }
        
        
        //Altera os dados do usuário
        $update = $user->update($dataUser);
        
        if( $update )
            return redirect()
                        ->route('profile')
                        ->with(['success' => 'Perfil atualizado com sucesso']);
        else
            return redirect()->route('profile')
                                        ->withErrors(['errors' => 'Falha ao atualizar o perfil.'])
                                        ->withInput();
    }
}
