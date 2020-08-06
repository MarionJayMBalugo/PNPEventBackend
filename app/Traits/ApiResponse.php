<?php
namespace app\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validators;
use Illuminate\Pagination\LenghtAwarePaginator;

trait ApiResponse {

	/**
     * The attribute that contains the json response.
     *
     * @var array
     */
	private $response = [];

	 /**
     * formats the json response for successful request.
     *
     * @param  string  $data
	 * @param  string  $message
	 * @param  int  $code
     * @return json
     */
    protected function successResponse( $data, $message = null, $code = 200)
	{
		$this->setResponse( "Success", $data, $message);
		return response()->json( $this->getResponse(), $code);
	}

	/**
     * formats the json response for unsuccessful request.
     *
     * @param  string  $data
	 * @param  string  $message
	 * @param  int  $code
     * @return json
     */
	protected function errorResponse($message = null, $code = 404)
	{
		$this->setResponse( "Error", null, $message);
		return response()->json( $this->getResponse(), $code);
	}

	/**
     * setter for $response attribute.
     *
     * @param  string  $status
	 * @param  string  $data
	 * @param  string  $message
     */
	protected function setResponse($status, $data = null, $message = null) {
		$this->response[ "status"] = $status;
		$this->response[ "message"] = $message;
		$this->response[ "data"] = $data;
	}
	
	/**
     * getter for $response attribute.
     *
     * @return array
     */
	protected function getResponse() {
		return $this->response;
	}
}