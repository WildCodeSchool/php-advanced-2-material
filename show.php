<?php

require_once 'config.php';
require __DIR__.'/src/models/recipe-model.php';

// Input GET parameter validation (integer >0)
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
if (false === $id || null === $id) {
    header("Location: /");
    exit("Wrong input parameter");
}

// Fetching a recipe
$recipe = getRecipeById($id);

// Result check
if (!isset($recipe['title']) || !isset($recipe['description'])) {
  header("Location: /");
  exit("Recipe not found");
}

// Generate the web page
require __DIR__.'/src/views/show.php';
