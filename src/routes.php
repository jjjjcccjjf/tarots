<?php

// Routes
$app->get('/', function ($request, $response, $args) {

  $T = new \Crud($this->db);
  $data = $T->all();

  // Render index view
  return $this->renderer->render($response, 'index.phtml', [
    'tarots' => $data
  ]);
});


$app->get('/tarots', function ($request, $response, $args) {

  $T = new Crud($this->db);
  $data = $T->getAll();

  $response->getBody()->write(var_dump(data));
  return $response;

});


$app->get('/users/{id}', function ($request, $response, $args) {

  $T = new Crud($this->db);
  $data = $T->get($args['id']);

  $response->getBody()->write(var_dump($data));
  return $response;

});

$app->patch('/tarots/{id}', function ($request, $response, $args) {

  $data = $request->getParsedBody();
  $id = filter_var($args['id'], FILTER_SANITIZE_STRING);

  $T = new Crud($this->db);
  $result = $T->update($id, $data);

  return $response->getBody()->write(var_dump($result));

});

$app->delete('/tarots/{id}', function ($request, $response, $args) {

  $id = filter_var($args['id'], FILTER_SANITIZE_STRING);

  $T = new Crud($this->db);
  $result = $T->delete($args['id']);

  return $response->getBody()->write(var_dump($result));
});


$app->post('/tarots/new', function ($request, $response, $args) {

  $data = $request->getParsedBody();

  $T = new Crud($this->db);

  $insert_data = [];
  foreach($data as $key => $val){
    $insert_data[$key] = filter_var($val, FILTER_SANITIZE_STRING);
  }

  $result = $T->add($insert_data);

  $response->getBody()->write(var_dump($result));
  return $response;

});
