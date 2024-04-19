<?php
require_once $_SESSION['MODELS_PATH'] . '/PortfolioModel.php';

class Controller {
    private $portfolioModel;

    // Constructor
    public function __construct() {
        
        $this->portfolioModel = new PortfolioModel();
        
    }
}