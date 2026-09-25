<?php


namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AbstractException extends Exception
{
    protected $code;
    protected $message = [];

    public function __construct($code = Response::HTTP_INTERNAL_SERVER_ERROR, $message = null)
    {
        $this->code = $code;
        $this->message = $message ?: 'Server Exception';

        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
        return redirect()->back()->with('error', $this->message)->withInput();
    }

    public function report()
    {
        Log::emergency($this->message);
    }

}
