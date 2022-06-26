<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request. 
     * FR: Authorize should return true unless we have a authorization logic by default, in case we have a false return that request is not going to be authorized, if we need it we can create a logic layer here to authorize or not the request but for now we are going to return true by default
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // if false returns a page with 403 error unauthorized
    }

    // ## To use this ProductRequest in our controller we have to inject Request in the arguments as we did it with Product but with our own request such as ProductRequest we put it first in the arguments

    /**
     * Get the validation rules that apply to the request.
     * FR: rules from the form validation 
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
    }

    /**
     * Ejecutaria esta validacion despuesd de rules esta validacion estaba en el controller pero ahora acá 
     * Primero se ejecutan las validaciones para las reglas del metodo rules() una vez teniendo el request listo puede acceder aca para seguir con esta validacion
     */
    public function withValidator($validator){  

        // fn anonina q recibe el validador y se ejecuta despues de las validaciones iniciales 
        $validator->after(function ($validator){

        // * Como acá estamos dentro del request no usamos $request sino usamos this
        // Valido con session  * No usamos request helper sino el instanciado ya que usamos el form request que representa la peticion que acabamos de recibir al ejecutar
            if ($this->status == 'available' && $this->stock == 0) {

                $validator->errors()->add('stock', 'If available must have stock'); // key value metodo errors y agregamos el key stock y el value el msj
            }
        });

        /*  // ## Validacion de session anteriormente usada en product controller
        
             // Valido con session  * No usamos request helper sino el instanciado ya que usamos el form request que representa la peticion que acabamos de recibir al ejecutar
        // if (request()->status == 'available' && request()->stock == 0) {
        if ($request->status == 'available' && $request->stock == 0) {

            //
            // @method flash key value de poner info en la sesio pero solo esta disponible en la siguiente request si refrescamos o hacemos algo mas se quita
            // @method put : key value de poner informacion en la sesion pero queda permanente
            // @param error : nombre del key 
            // @param message : mensaje del key 
            /// 
            // session()->put('error', 'If available must have stock'); // debe tener stock si esta disponible
            // -- no lo necesito mas por withErrors FN // * session()->flash('error', 'If available must have stock'); // debe tener stock si esta disponible, ademas flash ya aplicar forget en el refresco de sitio o redirect

            //envio con el metodo withInput y dentro el helper request con el metodo all para que envie toda la data de los inputs y tener tambien los valores ya que haciamos un redirect back sin esa data
            return redirect()
                    ->back()
                    ->withInput($request->all())
                    ->withErrors('If avalaible must have stock');
                    // -- withErrors usa la var global errors para poder usarla y mostrar esos errores y asi no necesitamos crear una var de session de errores aunque podriamos usarla para success si quisieramos
        }
        
        */

    }
}
