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

    #[LiveProp()]
    public bool $gameOver = false;

    #[LiveProp()]
    public int $spaceship = 5;

    public function __construct()
    {
        if(empty($this->asteroids)){
            $this->asteroids[0] = rand(0, 9);
        }
    }

    #[LiveAction]
    public function addAsteroid()
    {
        if(isset($this->asteroids[9]) && $this->spaceship === $this->asteroids[9]){
            $this->gameOver = true;
            $this->isRunning = false;
        }
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

    #[LiveAction]
    public function moveLeft()
    {
        if ($this->spaceship > 0 && $this->isRunning) {
            $this->spaceship--;
        }
    }

    #[LiveAction]
    public function moveRight()
    {
        if ($this->spaceship < 9 && $this->isRunning) {
            $this->spaceship++;
        }
    }


}
