<?php
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostContadorCodigo;
use App\Models\Comment;
use Mail;
use App\Mail\SendContact;
use DB;
class SiteController extends Controller
{
    private $post;
    private $postContadorCodigo;
    private $totalPage = 6;
    
    public function __construct(Post $post,PostContadorCodigo $postContadorCodigo)
    {
        $this->post = $post;
        $this->postContadorCodigo = $postContadorCodigo;
    }
    
    public function index()
    {
        $title = 'Blog EspecializaTi';
        $post = $this->post->where('featured', true)->get()->first();
       
        
        $postsFeatured = $this->post
                                    ->where('featured', true)
                                    ->limit(3)
                                    ->get();
        
        $posts = $this->post->orderBy('date', 'ASC')->paginate($this->totalPage);
        
        return view('site.home.index', compact('title', 'postsFeatured', 'posts','post'));
    }
    
     public function instrucao(Category $category)
    {
        $title = 'Como Funciona';
        
        return view('site.instrucao.instrucao', compact('title'));
    }
    public function company(Category $category)
    {
        $title = 'Empresa Mailson';
        
        return view('site.company.company', compact('title'));
    }
    
    public function contact(Category $category)
    {
        $title = 'Contato Mailson';
        
        return view('site.contact.contact', compact('title'));
    }
    
    
    public function category(Category $category, $url)
    {
        $category = $category->where('url', $url)->get()->first();
        
        $title = "Categoria {$category->name} - EspecializaTi";
        
        $posts = $category->posts()->paginate($this->totalPage);
        
        return view('site.category.category', compact('category', 'posts', 'title'));
    }
    
    
    public function post($url,$id)
    {
        $post = $this->post->where('url', $url)->get()->first();
       
        $postContadorCodigo = $this->postContadorCodigo->where('id', $id)->get()->first();
          $postContadorCodigo1 = $this->postContadorCodigo->where('id', $id)->get()->first();
          
             $postContadorCodigo2 = DB::table('post_contador_codigo')
                ->join('posts', 'posts.id', '=', 'post_contador_codigo.post_id')
                ->join('contador_registro', 'contador_registro.id', '=', 'post_contador_codigo.contador_id')
                ->select('contador_registro.codigo as codigo','posts.image as image', 'post_contador_codigo.contador as contador', 'post_contador_codigo.id as id', 'posts.url as url', 'posts.description as description', 'post_contador_codigo.post_id as post_id')
                ->where('post_contador_codigo.id', $id)
                
                ->first();
       
       
     
        if ($postContadorCodigo['contador']==Null){
          $postContadorCodigo['contador'] =1;
          }else{
             $postContadorCodigo['contador']=$postContadorCodigo['contador']+1;
          }
         
        $update=$postContadorCodigo1->update(['contador'=>$postContadorCodigo['contador']]);
           
        $title = "{$post->title} - EspecializaTi";
        
        $postsRel = $this->post->where('id', '>', $post->id)->limit(4)->get();
        
        $author = $post->user;
       
        
        
        
        
        return view('site.post.post', compact('post', 'title', 'postsRel', 'author','postContadorCodigo','postContadorCodigo2','id'));
    }
    public function postUrl($url)
    {
   
        $post = $this->post->where('url', $url)->get()->first();
        
        $postContadorCodigo=Null;
        
        
        $title = "{$post->title} - EspecializaTi";
        
        $postsRel = $this->post->where('id', '>', $post->id)->limit(4)->get();
        
        $author = $post->user;
        
         
       
        
        return view('site.post.post', compact('post', 'title', 'postsRel', 'author','postContadorCodigo'));
    }
    
    
    public function commentPost(Request $request)
    {
        $comment = new Comment;
        
        $dataForm = $request->all();
        
        $validate = validator($dataForm, $comment->rules());
        if( $validate->fails() ) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }
        
        if( $comment->newComment($dataForm) )
            return '1';
        else
            return 'Falha ao cadastrar comentário.';
    }
    
    public function sendContact(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|min:3|max:100',
            'email'     => 'required|email|min:3|max:100',
            'subject'   => 'required|min:3|max:100',
            'message'   => 'required|min:3|max:1000',
        ]);
        
        $dataForm = $request->all();
        
        $mail = Mail::send(new SendContact($dataForm));
        
        return redirect('/contato')
                ->with(['success' => 'E-mail enviado com sucesso, em breve entraremos em contato com você!']);
    }
    
    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        
        $posts = $this
                    ->post
                    ->where('title', 'LIKE', "%{$dataForm['key-search']}%")
                    ->orWhere('description', 'LIKE', "%{$dataForm['key-search']}%")
                    ->orderBy('date', 'ASC')
                    ->paginate($this->totalPage);
        
                    
        return view('site.search.search', compact('dataForm', 'posts'));
    }
}