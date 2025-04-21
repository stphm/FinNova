<?php

namespace App\DataFixtures;

use App\Domain\Entity\Account;
use App\Domain\Entity\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AccountFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR'); 

        $types = ['Livret A', 'LEP', 'Compte courant', 'Assurance vie'];
        $category = [ 'Courses', 'Abonnement', 'Facture', 'Loisir', 'Salaire', 'Cadeau'];

        for ($i=0; $i < 5; $i++) { 
            $account = new Account();
            $account->setName($faker->company() . " " . $faker->word);
            $account->setType($faker->randomElement($types));
            $account->setBalance($faker->randomFloat(2, 500, 1000000 ));
            $account->setCreatedAt($faker->dateTimeBetween('-1 year', 'now'));
            
            $manager->persist($account);

            for ($j=0; $j < 15 ; $j++) { 
                $transaction = new Transaction();
                $transaction->setLabel($faker->company());
                $transaction->setAmount($faker->randomFloat(2, -200, 500));
                $transaction->setDate($faker->dateTimeBetween('-6 months', 'now'));
                $transaction->setCategory($faker->randomElement($category));
                $transaction->setAccount($account);

                $manager->persist($transaction);
            }
        }

        $manager->flush();
    }
}
