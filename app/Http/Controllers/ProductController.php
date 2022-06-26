<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function __construct()
    {
        // All funcitons inside this controller are protected with auth middleware
        $this->middleware('auth');
        // ->only(['index', 'create', 'etc']);  // solo a las que indico aca 
        // ->except(['index', 'create', 'etc']);// excepto a las que indico aca 
    }


    // * Query builder uses the Database and it's harder to make changes in the code if its needed bc the table name may change 
    // ? Eloquent uses the Model RECOMENDED it's harder to make changes in the code bc it only uses the model name not the table name
    // ? ORM Eloquent: more methods to manipulate data, add a format, excecute actions operations before and after getting data

    public function index(){
        // return 'This is the list of productos from controller';

        //* Query builder
        $products = DB::table('products')->get(); // get all products

        // ? Eloquent 
        // $products = Product::all();

        // dd($products);
        // return $products;

        // return view('products.index')->with(['products' => $products]);
        // return view('products.index')->with(['products' => []]);
        return view('products.index')->with(['products' => Product::all()]);
    }

    public function create(){
        // return 'This is a form to create a product from Controller';
        return view('products.create');
    }
    

    public function store(ProductRequest $request){

        // ## These rules are now in Requests/ProductRequest
        // // Reglas de mis inputs  //
        // $rules = [
        //     'title' => ['required', 'max:255'],
        //     'description' => ['required', 'max:1000'],
        //     'price' => ['required', 'min:1'],
        //     'stock' => ['required', 'min:0'],
        //     'status' => ['required', 'in:available,unavailable'],
        // ];
        // // con el helper der request valido los campos con las reglas
        // request()->validate($rules);


            // aca antes estaba la validcion de session pero ahora esta en el form request

        // eliminar info de la session
        // session()->forget('error'); // no falla sino existe

        // Metodo 1 cmapo por campo
        // $product = Product::create(request()->title,
        //                             request()->description); //se solicita por medio del helper de request campo por campo pero esto no es muy eficiente
        
        // * al no usar el helper de request() sino usar el isntanciado que usamos para el form request nos permite usar el metodo validated que retorna los validados en lugar de all
        // $product = Product::create(request()->all()); // se solicitan todos los campos y se llenan los que en el modelo estan en el array de fillable
        $product = Product::create(request()->validated()); // se solicitan todos los campos y se llenan los que en el modelo estan en el array de fillable
        // session()->flash('success', "The new product with id {$product->id} has been created "); // * se reemplaza por withSuccess
        // return $product;
        // return redirect()->back(); // hacia atras

        // return redirect()->action('MainController@index');
        // * recomendada con el name de ruta ya que es menos probable cambiar este name que el nombre del controlador o  metodo 
        return redirect()
               ->route('products.index')
            //    ->withErrors(['success', 'value']);  // withErrors crea la variable success al igual que withSuccess pero no es igual que withErrors porque no tiene una var global de success
               ->withSuccess("The new product with id {$product->id} has been created "); // * withSuccess esta agreando a la session la variable success para ser utilizada 
    }
    
    
    public function show(Product $product){
        // return "Showing product with id {$product} from Controller";

        // * Query Builder always get a collection even if its one element
        // $product = DB::table('products')->where('id' , $product)->get();

        // * Query Builder always get a collection even if its one element with first always get just one element not a collection
        // $product = DB::table('products')->where('id' , $product)->first();

        // * Query Builder method find() we dont need a where or first method  bc find already knows that we get just one element not a collection
        // $product = DB::table('products')->find($product);

        // ? Eloquent ORM 
        // $product = Product::find($product); // doesnt show a 404 page if the product doesnt exists 
        // $product = Product::findOrFail($product); // shows a 404 page if the product id doesnt exists return a null // ! ya no lo necesito por la inyeccion implicita de modelos en el parametro Product $product

        // dd($product); // show info and stop excecution

        return view('products.show')->with(['product' => $product, 'html' => '<h2>title h2 from controller</h2>']);
    }
    

    /**
     * View
     * Edit es el analogo de create 
     */
    public function edit(Product $product){

        // dd($product);

        // $product = Product::findOrFail($product);

        // dd($product);

        return view('products.edit')->with([
            // 'product' => Product::findOrFail($product), // ! ya no necesito findorfail por la inyeccion implicita de modelos Product $product
            'product' => $product, 
            
            ]
        );
        
    }
    

    /**
     * Edit view llama a update para actualizar
     * Update es el analogo de store
     */
    public function update( ProductRequest $request, Product $product){

        // ## These rules are now in Requests/ProductRequest 
        // $rules = [
        //     'title' => ['required', 'max:255'],
        //     'description' => ['required', 'max:1000'],
        //     'price' => ['required', 'min:1'],
        //     'stock' => ['required', 'min:0'],
        //     'status' => ['required', 'in:available,unavailable'],
        // ];
        // request()->validate($rules);

        
        // $product = Product::findOrFail($product);// ! ya no necesito findorfail por la inyeccion implicita de modelos Product $product
 
        // helper de request
        $product->update( $request->validated() );

        // return $product;
        // * recomendada con el name de ruta
        return redirect()->route('products.index')->withSuccess("The product with id {$product->id} was edited"); 
        
    }
    

    /**
     * Destroy por ruta esta obligado a hacer una petición delete y por ello no puede ser un enalce <a> debe haber un form que haga ese submit
     */
    public function destroy(Product $product){

        // $product = Product::findOrFail($product);// ! ya no necesito findorfail por la inyeccion implicita de modelos Product $product

        $product->delete();

        // return $product;
        // * recomendada con el name de ruta
        return redirect()->route('products.index')->withSuccess("The product with id {$product->id} was deleted");  

    }
    

}
