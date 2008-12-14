<?php
interface My_Application_Bootstrap
{
    public function __construct($application);
    public function setOptions(array $options);
    public function getApplication();
    public function getEnvironment();
    public function bootstrap();
    // public function run(); // ?
}
