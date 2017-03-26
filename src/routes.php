<?php
// Routes

$app->get('/tarots', function ($request, $response, $args) {
    // Sample log message
     $this->logger->info("Slim-Skeleton '/' route");

     $T = new Tarot($this->db);
     $tarots = $T->getAll();

     $response->getBody()->write(var_dump($tarots));
     return $response;

    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/tarot/{id}', function ($request, $response, $args) {
 
     $T = new Tarot($this->db);
     $tarots = $T->get($args['id']);

     $response->getBody()->write(var_dump($tarots));
     return $response;

    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);
});

$app->put('/tarot/{id}', function ($request, $response, $args) {
 
 	 $data = $request->getParsedBody();
 	 $args['id'] = filter_var($args['id'], FILTER_SANITIZE_STRING);
 	 
     $T = new Tarot($this->db);

     $result = $T->update($args['id'], $data);

     return $response->getBody()->write(var_dump($result));
});

$app->delete('/tarot/{id}', function ($request, $response, $args) {
 
 	 $args['id'] = filter_var($args['id'], FILTER_SANITIZE_STRING);

     $T = new Tarot($this->db);
     $result = $T->deleteById($args['id']);

     return $response->getBody()->write(var_dump($result));
});


$app->post('/tarot/new', function ($request, $response, $args) {
 
 	$data = $request->getParsedBody();
    
    $T = new Tarot($this->db);
     
    $tarot_data = [];
    $tarot_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $tarot_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
    $tarot_data['photo'] = filter_var($data['photo'], FILTER_SANITIZE_STRING);

    $result = $T->add($tarot_data);

    $response->getBody()->write(var_dump($result));
    return $response;

    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);
});

