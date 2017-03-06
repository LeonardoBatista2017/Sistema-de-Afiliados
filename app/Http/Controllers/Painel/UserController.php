<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\ContadorRegistro;
use DB;
use App\Http\Requests\Painel\UserFormRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    private $user;
    protected $totalPage = 10;
    private $contador;

    public function __construct(User $user, ContadorRegistro $contador) {
        $this->user = $user;
        $this->contador = $contador;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = 'Listagem dos Usuários';
        
        if(Auth::user()->id==16){
             $users =User::get();
      
        return view('painel.users.index-admin', compact('users', 'title'));
        }else{
             $user_id=Auth::user()->id;
       
        $users = $this->user->find($user_id);
      
        return view('painel.users.index', compact('users', 'title'));
        }
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = 'Cadastrar Novo Usuário';


        return view('painel.users.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request) {


        //Pega todos os dados do usuário
        $dataUser = $request->all();

        //Criptografa a senha
        $dataUser['password'] = bcrypt($dataUser['password']);

        //Verifica se existe a imagem
        if ($request->hasFile('image')) {
            //Pega a imagem
            $image = $request->file('image');

            //Define o nome para a imagem
            $nameImage = uniqid(date('YmdHis')) . '.' . $image->getClientOriginalExtension();

            $upload = $image->storeAs('users', $nameImage);

            if ($upload)
                $dataUser['image'] = $nameImage;
            else
                return redirect('/painel/usuarios/create')
                                ->withErrors(['errors' => 'Erro no Upload'])
                                ->withInput();
        }

        //Insere os dados do usuário
        $insert = $this->user->create($dataUser);

        if ($insert)
            return redirect()
                            ->route('usuarios.index')
                            ->with(['success' => 'Cadastro realizado com sucesso!']);
        else
            return redirect()->route('usuarios.create')
                            ->withErrors(['errors' => 'Falha ao cadastrar!'])
                            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        if (Auth::user()->id == $id || Auth::user()->id==16) {
            //Recupera o usuário
            $user = $this->user->find($id);
               $contadores=DB::table('contador_registro')
                    ->join('users','users.id','=','contador_registro.user_id')
                    ->select('contador_registro.codigo as codigo')
                    ->where('user_id',$id)
                    ->get();
               
        } else {
            echo "Acesso Negado";
        }

        $title = "Usuário: {$user->name}";

        return view('painel.users.show', compact('user', 'title','contadores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (Auth::user()->id == $id || Auth::user()->id==16) {

            //Recupera o usuário pelo id
            $user = $this->user->find($id);
        } else {
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
    public function update(UserFormRequest $request, $id) {

        if (Auth::user()->id == $id) {
            //Pega todos os dados do usuário
            $dataUser = $request->all();



            //Cria o objeto de usuário
            $user = $this->user->find($id);

            //Criptografa a senha
            if (isset($dataUser['password']) && $dataUser['password'] != '')
                $dataUser['password'] = bcrypt($dataUser['password']);

            //Verifica se existe a imagem
            if ($request->hasFile('image')) {
                //Pega a imagem
                $image = $request->file('image');

                //Verifica se o nome da imagem não existe
                if ($user->image == '') {
                    $nameImage = uniqid(date('YmdHis')) . '.' . $image->getClientOriginalExtension();
                    $dataUser['image'] = $nameImage;
                } else {
                    $nameImage = $user->image;
                    $dataUser['image'] = $user->image;
                }

                $upload = $image->storeAs('users', $nameImage);

                if (!$upload)
                    return redirect()->route('usuarios.edit', ['id' => $id])
                                    ->withErrors(['errors' => 'Erro no Upload'])
                                    ->withInput();
            }
            //Gerando código 
            $user_id = $user['id'];
            $listaContador = DB::table('contador_registro')
                    ->orderBy('codigo', 'des')
                    ->get();
            
            //verifica se existe já usuário vinculado ao contador_registro
           $listaContador2 = DB::table('contador_registro')
                    ->where('user_id', $user_id)
                    ->get();
           
           
               if($listaContador2->isEmpty()){
            //inserindo o código no banco buscando ultimo registro
            foreach ($listaContador as $lista) {
                      
                    $lista->codigo=$lista->codigo+1;
                    $contadorRegistro = new ContadorRegistro();
                    $contadorRegistro->contador = 0;
                    $contadorRegistro->user_id = $user_id;
                    $contadorRegistro->codigo =$lista->codigo;
                    $contadorRegistro->save();
                
                break;
            }
     
               }
          

            //Altera os dados do usuário
            $update = $user->update($dataUser);
        } else {
            echo "Acesso Negado";
        }


        if ($update){
            return redirect()
                            ->route('usuarios.index')
                            ->with(['success' => 'Alteração realizada com sucesso!']);
        }else{
            return redirect()->route('usuarios.edit', ['id' => $id])
                            ->withErrors(['errors' => 'Falha ao editar'])
                            ->withInput();
    }
  }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        if (Auth::user()->id == $id) {
            //Recupera o usuário
            $user = $this->user->find($id);

            //deleta
            $delete = $user->delete();
        } else {
            echo "Acesso Negado";
        }
        if ($delete) {
            return redirect()->route('usuarios.index');
        } else {
            return redirect()->route('usuarios.show', ['id' => $id])
                            ->withErrors(['errors' => 'Falha ao deletar']);
        }
    }

    public function search(Request $request) {
        //Recupera os dados do formulário
        $dataForm = $request->except('_token');

        //Filtra os usuários
        $users = $this->user
                ->where('name', 'LIKE', "%{$dataForm['key-search']}%")
                ->orWhere('email', $dataForm['key-search'])
                ->paginate($this->totalPage);

        return view('painel.users.index', compact('users', 'dataForm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile() {
        //Recupera o usuário
        $user = auth()->user();

        $title = 'Meu Perfil';

        return view('painel.users.profile', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UserFormRequest $request, $id) {
        //Pega todos os dados do usuário
        $dataUser = $request->all();

        //Cria o objeto de usuário
        $user = $this->user->find($id);

        //Criptografa a senha
        $dataUser['password'] = bcrypt($dataUser['password']);

        //Remove o e-mail do usuário para não atualizar
        unset($dataUser['email']);

        //Verifica se existe a imagem
        if ($request->hasFile('image')) {
            //Pega a imagem
            $image = $request->file('image');

            //Verifica se o nome da imagem não existe
            if ($user->image == '') {
                $nameImage = uniqid(date('YmdHis')) . '.' . $image->getClientOriginalExtension();
                $dataUser['image'] = $nameImage;
            } else {
                $nameImage = $user->image;
                $dataUser['image'] = $user->image;
            }

            $upload = $image->storeAs('users', $nameImage);

            if (!$upload)
                return redirect()->route('profile')
                                ->withErrors(['errors' => 'Erro no Upload'])
                                ->withInput();
        }


        //Altera os dados do usuário
        $update = $user->update($dataUser);

        if ($update)
            return redirect()
                            ->route('profile')
                            ->with(['success' => 'Perfil atualizado com sucesso']);
        else
            return redirect()->route('profile')
                            ->withErrors(['errors' => 'Falha ao atualizar o perfil.'])
                            ->withInput();
    }

}
