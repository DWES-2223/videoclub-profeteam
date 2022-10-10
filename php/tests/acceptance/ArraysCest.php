<?php

class ArraysCest
{
    public function _before(AcceptanceTester $I)
    {
    }


    public function try230WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/230.php');
        $I->seeInSource('<ul> <li>');
        $I->seeInSource('</li> </ul>');
    }

    public function try231WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/231.html');
        $I->fillField('pregunta', 'Has anat a correr hui?');
        $I->click('submit');
        $I->seeInCurrentUrl('/231.php');
        $I->see("La resposta a 'Has anat a correr hui?' és: ");
    }

    public function try234WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/234.php');
        $I->see('Posa la quantitat a la variable quantitat pel QueryString');
        $I->amOnPage('/234.php?quantitat=347');
        $I->see('1 bitllet de 200');
        $I->see('1 bitllet de 100');
        $I->see('1 bitllet de 5');
        $I->see('1 moneda de 2');
    }

    public function try235WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/235.php');

        $I->seeInSource('<table> <thead> <tr> <th>Nom</th> <th>Alçada</th> </tr> </thead>');

    }

    public function try236WorksTest(AcceptanceTester $I)
    {
        $I->amOnPage('/236.php');

        $I->seeInSource('<table> <thead> <tr> <th>Nom</th> <th>Alçada</th> <th>Email</th> </tr> </thead>');

    }

}
