<?php
class HeroMapper {
    public static function mapToObject(array $heroData): Hero {
       
        return new Hero(
             $heroData["id"],
             $heroData["img"],
             $heroData["nom"],
             $heroData["hp"],
             $heroData["attack"]

        );
       
    }
}
?>