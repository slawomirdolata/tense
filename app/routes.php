<?php
declare(strict_types=1);

//use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\Termin\ListTerminsAction;
use App\Application\Actions\Termin\ViewTerminAction;
use App\Application\Actions\Termin\EditTerminAction;
use App\Application\Actions\Termin\AddTerminAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    /*$app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->get('/admin', function (Request $request, Response $response) {
        //$response->getBody()->write('AAADDDDDDMMMIIINNN');
        //return $response;

        $db = $this->get(PDO::class);
        $sth = $db->prepare('SELECT * FROM termins');
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });*/

    $app->get('/admin', function (Request $request, Response $response) {
        $file = 'public/admin.html';
        if (file_exists($file)) {
            $response->getBody()->write(file_get_contents($file));
            return $response;
        } else {
            throw new \Slim\Exception\NotFoundException($request, $response);
        }
    });

    $app->group('/api', function (Group $group) {
        $group->get('', ListTerminsAction::class);
        $group->get('/{id}', ViewTerminAction::class);
        $group->post('/{id}', EditTerminAction::class);
        $group->put('', AddTerminAction::class);
        $group->delete('/{id}', DeleteTerminAction::class);
    });
};
