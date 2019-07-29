<?php
try {

    $username = "portal";
    $password = "1d4c0559-ae29-4f6a-92ef-ccc3174eb99d";
    $firmNR = "111";
    $periodNR = "1";


    $soapURL = 'http://94.130.137.85/AS_LOGOWEBSERVICE/LOGOTIGER.asmx?wsdl';
    $client = new SoapClient($soapURL, array());
    $auth = array(
        'Username' => $username,
        'Password' => $password,
        'FirmNR' => $firmNR,
        'PeriodNR' => $periodNR,
        'WorkNR' => '',
    );
    $header = new SoapHeader('http://adminsoft.com.tr/', 'Authentication', $auth, false);
    $client->__setSoapHeaders($header);


    /* List of WSDL methods */
    echo "<pre>";
    var_dump($client->__getFunctions());

    echo '<br><br><br>';

    /* Executing a fuction, for example UserCheck*/
    $responseUserCheck = $client->UserCheck();
    var_dump($responseUserCheck);


    /* Executing a fuction, for example GetClientCardList*/
    $responseGetClientCardList = $client->GetClientCardList();
    $array = json_decode(json_encode($responseGetClientCardList), true);

    echo '<br><br><br>';

    echo  "Liste sonucundaki ilk kartın adı : <b>" . $array['GetClientCardListResult']['ClientCard']['0']['DEFINITION_'] . "</b>";

    /* Details of GetClientCardList */
    echo '<br><br><br>';
    foreach ($array as $item) {
        echo '<pre>';
        var_dump($item);
    }
    print_r($array);

    
    /* Create a new client card*/
    $arrayClientCard = array(
        "ClientCard" => array(
            "LOGICALREF" =>  "0",
            "ISPERSCOMP" =>  "1",
            "CODE" =>  "CODE111",
            "DEFINITION_" =>  "CARI UNVAN",
            "DEFINITION2" =>  "CARI UNVAN 2",
            "NAME" =>  "",
            "SURNAME" =>  "",
            "ADDR1" =>  "",
            "ADDR2" =>  "",
            "TOWNCODE" =>  "",
            "TOWN" =>  "",
            "CITYCODE" =>  "",
            "CITY" =>  "",
            "COUNTRYCODE" =>  "",
            "COUNTRY" =>  "",
            "POSTCODE" =>  "",
            "TELCODES1" =>  "",
            "TELCODES2" =>  "",
            "TELNRS1" =>  "",
            "TELNRS2" =>  "",
            "TELEXTNUMS1" =>  "",
            "TELEXTNUMS2" =>  "",
            "FAXCODE" =>  "",
            "FAXNR" =>  "",
            "FAXEXTNUM" =>  "",
            "TCKNO" =>  "17768815565",
            "TAXNR" =>  "",
            "TAXOFFICE" =>  "",
            "INCHARGE" =>  "",
            "INCHARGE2" =>  "",
            "INCHARGE3" =>  "",
            "EMAILADDR" =>  "",
            "EMAILADDR2" =>  "",
            "EMAILADDR3" =>  "",
            "CYPHCODE" =>  "",
            "SPECODE" =>  "",
            "SPECODE2" =>  "",
            "SPECODE3" =>  "",
            "SPECODE4" =>  "",
            "SPECODE5" =>  "",
            "EXTACCESSFLAGS" =>  "",
            "ACCEPTEINV" =>  "",
            "PURCHBRWS" =>  "1",
            "SALESBRWS" =>  "1",
            "IMPBRWS" =>  "1",
            "EXPBRWS" =>  "1",
            "FINBRWS" =>  "1"
        )
    );
    $responseNewClientCard = $client->SaveClientCard($arrayClientCard);
    var_dump($responseNewClientCard);

} catch (Exception $e) {
    echo $e->getMessage();
}
