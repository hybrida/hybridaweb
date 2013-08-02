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

	public function test_truncate() {
		$string = "123456789";
		$length = 5;
		$omission = "...";
		$truncated = Html::truncate($string, $length, $omission);

		$this->assertEquals("12345...", $truncated);

		$length2 = 10;
		$truncated2 = Html::truncate($string, $length2, $omission);

		$this->assertEquals($string, $truncated2);
	}
}