<?php
header('Content-type: application/json');
require_once "vendor/autoload.php";

use Dotenv\Dotenv;
use App\Car;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

if (getenv('APP_ENV') != 'production') {
    $res = [
        'status' => 401,
        'message' => 'Verifique as configurações de ambiente.'
    ];
    exit(json_encode($res));
}
$car = new Car();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = file_get_contents('php://input');
        $result = $car->save(json_decode($data) ?? null);
        $res = ['status' => 200, 'result' => $result];
        exit(json_encode($res));
    case 'GET':
        $data = $car->all();
        $res = ['status' => 200, 'result' => $data ?? false];
        exit(json_encode($res));
    default:
        $res = ['status' => 404, 'msg' => 'Rota não encontrada'];
        exit(json_encode($res));
}