<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class Game
{
    use DefaultActionTrait;

    #[LiveProp()]
    public array $asteroids = [];

    #[LiveProp()]
    public bool $isRunning = false;

    public function __construct()
    {
        if(empty($this->asteroids)){
            $this->asteroids[0] = rand(0, 9);
        }
    }

    #[LiveAction]
    public function addAsteroid()
    {
        array_unshift($this->asteroids, rand(0, 9));

        if(count($this->asteroids) > 10){
            array_pop($this->asteroids);
        }
    }

    #[LiveAction]
    public function toggleRunning()
    {
        $this->isRunning = !$this->isRunning;
    }


}
