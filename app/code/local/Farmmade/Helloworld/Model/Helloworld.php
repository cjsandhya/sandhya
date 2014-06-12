<?php
class Farmmade_Helloworld_Model_Helloworld extends Varien_Object
{
	function __construct() {
		parent::__construct();
	}
	
	function helloworld($arg)
    {
        echo "<br>Hello World! My argument is : " . $arg;
    }
}