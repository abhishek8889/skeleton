<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($result , $message){
        $response = [
            'success' => true,
            'status' => 'success',
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
	 * return error response.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sendError($result, $message, $code = 404)
	{
		$response = [
			'success' => false,
			'status' => 'failed',
			'data'    => $result,
			'message' => $message,
		];

		return response()->json($response, $code);
	}

	public function paginate($items)
	{
		// return new Paginator($items, 9);
	}
}
