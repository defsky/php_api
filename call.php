<?php
require_once('vendor/autoload.php');

$method = $_SERVER['REQUEST_METHOD'];

$response = (object)array(
    'ret' => -99,
    'message' => 'unknown error',
    'error' => (object)array(),
    'data' => (object)array()
);

try 
{
    switch ($method)
    {
        case 'GET':
            throw new Exception('you get the page', 1);

            break;
        case 'POST':
            $data =json_decode( file_get_contents('php://input'), true);
    
            $timestamp = $data['t'];
            $random = $data['r'];
            $signature = $data['s'];
            $params = $data['params'];
    
            $sig = new Signature($timestamp, $random);
    
            $response->ret = 0;
            $response->message = 'you post the page';
            $response->data = array(
                't' => $timestamp,
                'r' => $random,
                's' => $signature,
                's2' => $sig->digest(),
                'p' => $params
            );
            break;
        default:
            throw new Exception('unknown request method', -98);
    }
}
catch (Exception $e)
{
    $response->ret = $e->getCode();
    $response->message = $e->getMessage();
}

header("Content-type: application/json; charset=utf8");

echo json_encode($response);
