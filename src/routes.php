<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $stmt = $this->db->prepare('SELECT * FROM tarots WHERE 1');
	$stmt->execute();
	$tarots = $stmt->fetch();

     $response->getBody()->write(var_dump($tarots));
     return $response;

    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);
});
