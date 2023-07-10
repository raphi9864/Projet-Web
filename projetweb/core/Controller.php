<?php

class Controller
{
    protected $model;
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    // Méthode pour charger le modèle associé au contrôleur
    protected function loadModel($modelName)
    {
        require_once "app/models/" . $modelName . ".php";
        $this->model = new $modelName();
    }
}