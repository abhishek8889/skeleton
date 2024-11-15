<?php

namespace App\Services;


class Service
{


	public function initCass($class)
	{
		return new $class;
	}

	public function sendResponse($result, $message)
	{
		$response = [
			'success' => true,
			'status' => 'success',
			'data'    => $result,
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


		/* if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }*/


		return response()->json($response, $code);
	}
}
