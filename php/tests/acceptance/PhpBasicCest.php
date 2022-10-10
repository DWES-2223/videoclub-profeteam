<?php

class PhpBasicCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Hola món des del CIFP Batoi');
    }

    public function try202WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/202.php');
        $I->see('Suma: 166 + 199 = 365');
        $I->see('Resta: 166 - 199 = -33');
        $I->see('Multiplicació: 166 x 199 = 33034');

    }

    public function try203WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/203.php');
        $I->seeInSource('<td>Nom</td>');
        $I->seeInSource('<td>Cognoms</td>');
        $I->see('Email');
        $I->see('Natalici');
        $I->see('Telèfon');
    }

    public function try204WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/204.html');
        $I->fillField('nom', 'Ignasi');
        $I->fillField('cognom1', 'Gomis');
        $I->fillField('cognom2', 'Mullor');
        $I->fillField('email', 'igomis@cipfpbatoi.es');
        $I->fillField('any', '1968');
        $I->fillField('telefon', '600100345');
        $I->click('submit');
        $I->seeInCurrentUrl('/204.php');
        $I->seeInSource('<td>Nom</td> <td>Ignasi</td>');
        $I->seeInSource('<td>Cognoms</td> <td>Gomis Mullor</td>');
        $I->see('igomis@cipfpbatoi.es');
        $I->see('1968');
        $I->see('600100345');
    }

    public function try205WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/205.html');
        $I->fillField('verb', 'Anar');
        $I->fillField('nom', 'Cine');
        $I->fillField('adjetiu', 'blaU');
        $I->fillField('adverbi', 'lentAment');
        $I->click('submit');
        $I->seeInCurrentUrl('/205.php');
        $I->see('anar');
        $I->see('cine');
        $I->see('blau');
        $I->see('lentament');
    }

    public function try206WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/206.php');
        $I->see('Posa la teu edat actual a la variable edat pel QueryString');
        $I->amOnPage('/206.php?edat=50');
        $I->see('40');
        $I->see('60');
        $I->see('2039');
    }

    public function try207WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/207.php');
        $I->see('Posa la quantitat a la variable quantitat pel QueryString');
        $I->amOnPage('/207.php?quantitat=347');
        $I->see('1 bitllet de 200');
        $I->see('1 bitllet de 100');
        $I->see('1 bitllet de 5');
        $I->see('1 moneda de 2');
    }

    public function try208WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/208.php');
        $I->see('Posa el numero a comprobar a la variable numero del QueryString');
        $I->amOnPage('/208.php?numero=40');
        $I->see('El número 40 és positiu');
        $I->amOnPage('/208.php?numero=-40');
        $I->see('El número -40 és negatiu');
        $I->amOnPage('/208.php?numero=0');
        $I->see('El número 0 és zero');
    }

    public function try209WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/209.php');
        $I->see('Posa els números a comprobar a les variables numero1,numero2 i numero3 pel QueryString');
        $I->amOnPage('/209.php?numero1=40&numero2=12&numero3=5');
        $I->see('El nombre més gran entre 40, 12 i 5 és el 40');
        $I->amOnPage('/209.php?numero1=10&numero2=5&numero3=15');
        $I->see('El nombre més gran entre 10, 5 i 15 és el 15');
    }

    public function try210WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/206.php');
        $I->see('Posa la teu edat actual a la variable edat pel QueryString');
        $I->amOnPage('/210.php?edat=56');
        $I->see('ets un adult');
        $I->amOnPage('/210.php?edat=5');
        $I->see('ets un xiquet');
    }

    public function try211WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/211.php');
        $I->see('Posa les variables hora, minut i segon pel QueryString');
        $I->amOnPage('/211.php?hora=22&minut=59&segon=59');
        $I->see('23:0:0');
        $I->amOnPage('/211.php?hora=7&minut=58&segon=59');
        $I->see('7:59:0');
    }

    public function try212WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/212.php');
        $I->see('Posa les variables a, b i c pel QueryStrin');
        $I->amOnPage('/212.php?a=2&b=2&c=2');
        $I->see('Sense solució');
        $I->amOnPage('/212.php?a=2&b=3&c=1');
        $I->see('Les solucions son: -0.5 i -1');
        $I->amOnPage('/212.php?a=1&b=2&c=1');
        $I->see('La solució es: -1');
    }




}
