<?php


namespace App\Tests\Framework;


use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MyTestCase extends WebTestCase
{
    protected $client;
    protected $crawler;
    protected $em;

    /*
     * Méthode exécutée avant chaque test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();//création du client => le navigateur
        $this->em = static::$container->get("doctrine")->getManager();//récupération de l'entity manager
        //outil de gestion de la bdd
        $schemaTool = new SchemaTool($this->em);
        //suppression de la bdd
        $schemaTool->dropDatabase();
        //création de la bdd
        static $metadata = null;
        if(! $metadata){
            $metadata = $this->em->getMetadataFactory()->getAllMetadata();
        }
        $schemaTool->createSchema($metadata);
    }

    /**
     * @param \Throwable $t
     * @throws \Throwable
     */
    protected function onNotSuccessfulTest(\Throwable $t): void
    {
        if($this->crawler && $this->crawler->filter("h1.exception-message")->count() > 0){
            $trowableClass = get_class($t);
            throw new $trowableClass($this->crawler->filter("h1.exception-message")->text());
        }
        parent::onNotSuccessfulTest($t);
    }

    /*
     * Méthode exécutée après chaque test
     */
    public function tearDown(): void
    {
        parent::setUp();

        $this->em->close();
        $this->em = null;
    }
}
