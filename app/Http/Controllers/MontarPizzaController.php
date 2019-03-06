<?php namespace testeUDS\Http\Controllers;

use testeUDS\Http\Requests;
use testeUDS\Http\Controllers\Controller;
use GuzzleHttp;

use Illuminate\Http\Request;

class MontarPizzaController extends Controller {

    private $valor_total = 0.00;
    private $tempo_preparo_total = 0;
    private $pizza_id = 0;
    private $pedido = [];


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        /*return view('entrega.index')->with(['filter' => $filter,
            'grid'   => $grid]);;*/
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('montar_pizza.create');
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->pizza_id = $this->createPizza($request);
        $this->createPizzaAdicional($request,$this->pizza_id );
        $this->pedido =  $this->createPedido($this->pizza_id);

        return $this->montar();

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    private function createPizza($request){
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost:8010/api/pizza', [
            'form_params' => [
                'sabor_id' =>  $request->radioSabor,
                'tamanho_id' => $request->radioTamanho,
            ]
        ]);

        $this->atualizaTotais($request);

        $body = $response->getBody();
        $json =  GuzzleHttp\json_decode($body->__toString());

        return $json->id;

    }

    private function createPizzaAdicional($request,$pizza_id){

        //Personalizaçoes
        if ($request->checkboxExtraBacon)
            $this->sendPizzaAdicional($pizza_id,1);

        if ($request->checkboxSemCebola)
            $this->sendPizzaAdicional($pizza_id,2);

        if ($request->checkboxBordaRecheada){
            $this->sendPizzaAdicional($pizza_id,3);
        }

    }

    private function sendPizzaAdicional($pizza_id,$adicional_id){
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost:8010/api/pizzaAdicional', [
            'form_params' => [
                'pizza_id' =>  $pizza_id,
                'adicional_id' => $adicional_id,
            ]
        ]);
    }

    private function createPedido($pizza_id){
        $client = new GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost:8010/api/pedido', [
            'form_params' => [
                'pizza_id' =>  $pizza_id,
                'valor_total' => $this->valor_total,
                'tempo_preparo_total' => $this->tempo_preparo_total,
            ]
        ]);

        $body = $response->getBody();
        //$json =  GuzzleHttp\json_decode($body->__toString());
        return  json_decode($body->__toString(),true);


    }

    public function getPizza(){
        $client = new GuzzleHttp\Client();
        $response = $client->request('GET', "http://localhost:8010/api/pizza/$this->pizza_id", [
            /*'form_params' => [
                'id' =>  $this->pizza_id,
            ]*/
        ]);

        $body = $response->getBody();
        //$json =  GuzzleHttp\json_decode($body->__toString());
        return  json_decode($body->__toString(),true);

    }
    public function getPizzaAdicional(){
        $client = new GuzzleHttp\Client();
        $response = $client->request('GET', "http://localhost:8010/api/pizzaAdicional/$this->pizza_id", [
            /*'form_params' => [
                'pizza_id' =>  ,
            ]*/
        ]);

        $body = $response->getBody();
        //$json =  GuzzleHttp\json_decode($body->__toString());
        return  json_decode($body->__toString(),true);
    }

    public function atualizaTotais($request){
        //TAMANHO
        if ($request->radioTamanho == "1") { //PEQUENA
            $this->valor_total = 20;
            $this->tempo_preparo_total = 15;
        } else if ($request->radioTamanho == "2") { //MEDIA
            $this->valor_total = 30;
            $this->tempo_preparo_total = 20;
        } else { //GRANDE
            $this->valor_total = 40;
            $this->tempo_preparo_total = 25;
        }

        //SABOR
        if ($request->radioSabor == "3") { //PORTUGUESA
            $this->tempo_preparo_total += 5;
        }

        //Personalizaçoes
        if ($request->checkboxExtraBacon)
            $this->valor_total += 3;

        if ($request->checkboxBordaRecheada){
            $this->valor_total += 5;
            $this->tempo_preparo_total += 5;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function montar()
    {
        return view('montar_pizza.montar')->with(['pizza' => $this->getPizza(),
            'pizzaAdicional' => $this->getPizzaAdicional(), 'pedido' => $this->pedido]);
        //
    }



}
