<?php
class HeroMapper {

public static function mapToObject(array $data): Hero {
    $hero = new Hero(
    ($data['id']),
    ($data['nom']),
    ($data['img']),
    ($data['attack']),
    ($data['hp']),
    ($data['niveau'])
    );
    return $hero;
}
}
