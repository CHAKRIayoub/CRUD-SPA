<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;


class CustomerController extends Controller 
{
    private $Cnx;
	public function  __construct()
    {
		$woocommerceClient = new Client(
            // WOOCOMMERCE_SITE, CUSTOMER_KEY, CUSTOMER_SECRET, WORDPRESS_API, VERSION  
            //ces variables sont stocker dans le fichier .env
            env('WOOCOMMERCE_SITE'), 
    		env('CUSTOMER_KEY'), 
    		env('CUSTOMER_SECRET'), 
    		[
        		'wp_api' => env('WORDPRESS_API'),
        		'version' => env('VERSION')
    		]
		);
		 $this->Cnx = $woocommerceClient;
	}
    // functions____________________________________________________________________
    public function get_all_customers()
    {
    	return json_encode( $this->Cnx->get('customers'));
    }







    public function add_customer(Request $request){

        $this->validate($request, [

            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required'

        ]);
        
        $data = [

            'email' => $request->email,
            'first_name' => $request->first_name ,
            'last_name' => $request->last_name,
            'username' => $request->username ,
            'password' => 'password',
            'role' => $request->role,
            'billing' => [
                'first_name' => 'name',
                'last_name' => 'name',
                'company' => '',
                'address_1' => '969 Market',
                'address_2' => '',
                'city' => 'Fes',
                'state' => 'CA',
                'postcode' => '94103',
                'country' => 'MA',
                'email' => '',
                'phone' => '(212) 636-624186'
            ],
            'shipping' => [
                'first_name' => 'nameee',
                'last_name' => 'namee',
                'company' => '',
                'address_1' => '969 Market',
                'address_2' => '',
                'city' => 'Azrou',
                'state' => 'CA',
                'postcode' => '94103',
                'country' => 'MA'
            ]

        ];

    	return $this->Cnx->post('customers', $data);

    }

   





    public function update_customer(Request $request, $id){

         $this->validate($request, [

            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',

        ]);


        $data = [

             'email' => $request->email,
            'first_name' => $request->first_name ,
            'last_name' => $request->last_name,
            'role' => $request->role
            
        ];

    	return $this->Cnx->put('customers/' . $id , $data );
    }







    public function delete_customer($id){

    	return $this->Cnx->delete('customers/' . $id ,['force' => true] );

    }



    
}
