<?php

class HtmlTest extends CTestCase {

	public function test_StringReplace() {
		$text = "hei:pa:deg";
		$this->assertEquals("heipadeg",Html::removeSpecialChars($text));
	}
	
	public function test_removeSpecialChars_allowNorwegianLetters() {
		$text = "heisann_æøå";
		$this->assertEquals($text, Html::removeSpecialChars($text));
	}
}