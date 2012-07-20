<?php

class BpcUpdateTest extends CTestCase {
	
}

class BpcRequestMock extends BpcRequest {

	public function getResponse() {
		return array();
	}

	protected function sendRequest() {
		
	}

}

class BpcUpdateMock extends BpcUpdate {

	protected function getBpcResponse($postdata) {
		$request = new BpcRequestMock($postdata);
		$request->send();
		return $request->getResponse();
	}

}
