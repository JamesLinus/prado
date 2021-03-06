<?php

class ActiveHiddenFieldTestCase extends PradoGenericSelenium2Test
{
	function test()
	{
		$base='ctl0_Content_';
	    $this->url("active-controls/index.php?page=ActiveHiddenFieldTest");
	    $fieldEmpty = 'No longer empty';
	    $fieldUsed = 'My value';

	    $this->assertSourceContains('Value of current hidden field');
		$this->byId("{$base}Button1")->click();
		$this->pause(800);
		$this->assertText("{$base}ResponseLabel", $fieldEmpty);
		$this->byId("{$base}Button2")->click();
		$this->pause(800);
		$this->assertText("{$base}ResponseLabel", $fieldUsed);
		$this->byId("{$base}Button3")->click();
		$this->pause(800);
		$this->assertText("{$base}ResponseLabel", $fieldEmpty.'|'.$fieldUsed);
	}
}
