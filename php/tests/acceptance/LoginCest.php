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
        $I->see('amancio');
        $I->see('pablo');
    }

    public function tryLoginUserTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username','amancio');
        $I->fillField('password','1234');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainCliente.php');
        $I->see('amancio');
        $I->see('Logout');
        $I->see('El cliente tiene 3 soportes alquilados.');
    }

    public function tryFailUserTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username','amancio');
        $I->fillField('password','12345');
        $I->click('submit');
        $I->seeInCurrentUrl('/index.php');
        $I->seeInSource('<input type="text" name="username" placeholder="username" value="amancio"/>');
    }




}
