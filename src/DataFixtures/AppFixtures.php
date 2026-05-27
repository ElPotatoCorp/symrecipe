<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    private function loadIngredients(ObjectManager $manager): ArrayCollection
    {
        $collection = new ArrayCollection();
        for ($i = 1; $i <= 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setPrice(mt_rand(1, 199));
            $manager->persist($ingredient);
            $collection->add($ingredient);
        }
        $manager->flush();
        return $collection;
    }

    private function loadRecipes(ObjectManager $manager, ArrayCollection $ingredients): void
    {
        $nbIngredients = $ingredients->count();
        $ingredients = $ingredients->toArray();

        for ($i = 1; $i <= 10; $i++) {
            $recipe = new Recipe();

            $recipe->setName($this->faker->word())
                ->setTime($this->faker->numberBetween(5, 60))
                ->setNbPersons($this->faker->numberBetween(1,5))
                ->setDifficulty($this->faker->numberBetween(1,10))
                ->setDescription($this->faker->sentences(4, true))
                ->setPrice($this->faker->randomFloat(2, 0, 50))
                ->setIsFavorite($this->faker->boolean());

            $ingredients = $this->faker->shuffleArray($ingredients);
            for ($j = 0; $j <= $this->faker->numberBetween(1, $nbIngredients); $j++) {
                $recipe->addIngredient($ingredients[$j]);
            }

            $manager->persist($recipe);
        }
        $manager->flush();
    }

    public function load(ObjectManager $manager): void
    {
        $ingredients = $this->loadIngredients($manager);
        $this->loadRecipes($manager, $ingredients);
    }
}
