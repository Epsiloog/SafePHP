<?php

use PHPUnit\Framework\TestCase;
use SafePHP\Verify;

class VerifyTest extends TestCase {
    public function testVerify(){
        $boolValue = false;
        $intValue = 500;
        $floatValue = 54564.23;
        $doubleValue = 189762.356515165;
        $stringValue = "Lorem ipsum";
        $arrayValue = ["huids", 4646, "kdopsqj", false, 5.26, null];
        $objectValue = (object) 'ciao';
        $nullValue = null;


        $this->assertEquals(true, true, Verify::verify($intValue, "bool"));
        $this->assertEquals(true, true, Verify::verify($boolValue, "bool"));
        $this->assertEquals(false, false, Verify::verify($boolValue, "float"));
    }
}