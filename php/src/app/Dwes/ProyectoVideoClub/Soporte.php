<?php
namespace Dwes\ProyectoVideoClub;

use Goutte\Client;

/**
 *   Classe abstracta que conté els mètodes comuns de les seues classes derivades
 */
abstract class Soporte implements Resumible
{
    /**
     *
     */
    private const IVA = 0.21;

    /**
     * @var bool
     */
    public $alquilado = false;
    protected $metacritic;

    /**
     * @param $titulo
     * @param $numero
     * @param $precio
     */
    public function __construct(public $titulo, protected $numero, protected $precio)
    {
        //$this->setMetacritic();
    }

    /**
     * @return mixed
     */
    public function getMetacritic()
    {
        return $this->metacritic;
    }

    /**
     * @param mixed $metacritic
     */
    public function setMetacritic($metacritic=null): void
    {
        if ($metacritic) {
            $this->metacritic = $metacritic;
        } else {
            $client = new Client();
            $link = str_replace(' ', '%20', $this->titulo);
            $crawler = $client->request('GET', 'https://www.metacritic.com/search/all/'.$link.'/results');
            $metacritic = $crawler->filter('li.first_result a')->extract(['href']);
            if ($metacritic && count($metacritic)) {
                $this->setMetacritic($metacritic[0]);
            }
        }
    }


    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @return float
     */
    public function getPrecioConIVA()
    {
        return $this->getPrecio()+$this->getPrecio()*self::IVA;
    }

    /**
     * @return mixed|void
     */
    public function muestraResumen()
    {
        echo "<br>".$this->titulo."<br>".$this->getPrecio()." € (IVA no incluido) <br/> Puntuació: ".$this->getPuntuacion().'<br/>';
    }

    public function getPuntuacion()
    {
        $httpClient = new \Goutte\Client();
        if ($this->metacritic) {
            $response = $httpClient->request('GET', 'http://www.metacritic.com/'.$this->getMetacritic());
            $node = $response->filter('a.metascore_anchor .metascore_w');
            if (count($node)) {
                return $node->text();
            }
        }
        return 'Desconeguda';
    }
}


