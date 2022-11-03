<?php

class LoginCest
{

    public function tryindexTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username','AAA');
        $I->fillField('password','AAA');
        $I->click('submit');
        $I->seeInCurrentUrl('/index.php');
        $I->see('Accès incorrecte');
        $I->seeInSource('value="AAA"');
        $I->amOnPage('/index.php');
        $I->fillField('username','admin');
        $I->fillField('password','admin');
        $I->click('submit');
        $I->see('admin');
        $I->see('Logout');
    }

    public function tryNotLoginPHPTest(AcceptanceTester $I)
    {
        $I->amOnPage('/login.php');
        $I->seeInCurrentUrl('/index.php');


    }

    public function tryListadoTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username','admin');
        $I->fillField('password','admin');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainAdmin.php');
        $I->see('admin');
        $I->see('Logout');
        $I->see('God of War');
        $I->see('Amancio Ortega');
    }



    /*

    public function try414Test(AcceptanceTester $I)
    {
        $I->amOnPage('/414.php');
        $I->seeInCurrentUrl('/410.html');
        $I->amOnPage('/410.html');
        $I->fillField('username','usuari');
        $I->fillField('password','usuari');
        $I->click('submit');
        $I->seeInCurrentUrl('/412.php');
        $I->click('Sèries');
        $I->seeInCurrentUrl('/414.php');
        $I->seeInSource('<h2>Llista de sèries</h2>');
        $I->seeInSource('<li>Walking dead</li>');
        $I->click('Pel·licules');
        $I->seeInSource('<h2>Llista de pel·licules</h2>');
        $I->seeInSource('<li>Terminator 2</li>');
        $I->click('Logout');
        $I->seeInCurrentUrl('/410.html');
        $I->amOnPage('/412.php');
        $I->seeInCurrentUrl('/410.html');
    }
    */
}
