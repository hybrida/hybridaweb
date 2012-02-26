<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BpcWaitingList
 *
 * @author sighol
 */
class BpcWaitingList extends BpcAttending {

	protected function getRequest() {
		return 'get_waiting';
	}

}
