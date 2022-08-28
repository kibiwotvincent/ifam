<?php
 
namespace App\Exceptions;
 
use Exception;
use Illuminate\Http\Request;
 
class InvalidReportRequestException extends Exception
{
	/**
     * Message to return.
     *
     * @var string
     */
    public $message;

    /**
     * Create a new exception instance.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
	
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        return false;
    }
 
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
		return view('components.common.alert', ['type' => "danger", 'message' => $this->message])->render();
    }
}