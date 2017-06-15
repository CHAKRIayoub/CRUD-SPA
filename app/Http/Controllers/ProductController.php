<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;


class ProductController extends Controller 
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
    public function get_all_products()
    {
    	return json_encode( $this->Cnx->get('products'));
    }







    public function add_product(Request $request){

        $this->validate($request, [

            'name' => 'required',
            'type' => 'required',
            'sale_price' => 'required'

        ]);
        $data = [
            'name' => $request->name,
            'type' => $request->type,
            'slug' => $request->slug,
            'regular_price' => '21.99',
            'sale_price' => $request->sale_price,
            'description' => $request->description
        ];

    	return $this->Cnx->post('products', $data);

    }

   





    public function update_product(Request $request, $id){


        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'sale_price' => $request->sale_price,
            'description' => $request->description
        ];

    	return $this->Cnx->put('products/' . $id , $data );
    }







    public function delete_product($id){

    	return $this->Cnx->delete('products/' . $id ,['force' => true] );

    }



    
}
