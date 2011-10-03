<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author sigurd
 */
class WebUser extends CWebUser{
	
	
	public function __get($name) {
		return parent::__get($name);
	}

	public function __isset($name) {
		return parent::__isset($name);
	}

	public function __set($name, $value) {
		parent::__set($name, $value);
	}

	public function __unset($name) {
		parent::__unset($name);
	}

	protected function afterLogin($fromCookie) {
		parent::afterLogin($fromCookie);
	}

	protected function afterLogout() {
		parent::afterLogout();
	}

	protected function beforeLogin($id, $states, $fromCookie) {
		return parent::beforeLogin($id, $states, $fromCookie);
	}

	protected function beforeLogout() {
		return parent::beforeLogout();
	}

	protected function changeIdentity($id, $name, $states) {
		parent::changeIdentity($id, $name, $states);
	}

	public function checkAccess($operation, $params = array(), $allowCaching = true) {
		return parent::checkAccess($operation, $params, $allowCaching);
	}

	public function clearStates() {
		parent::clearStates();
	}

	protected function createIdentityCookie($name) {
		return parent::createIdentityCookie($name);
	}

	public function getFlash($key, $defaultValue = null, $delete = true) {
		return parent::getFlash($key, $defaultValue, $delete);
	}

	public function getFlashes($delete = true) {
		return parent::getFlashes($delete);
	}

	public function getId() {
		return parent::getId();
	}

	public function getIsGuest() {
		return parent::getIsGuest();
	}

	public function getName() {
		return parent::getName();
	}

	public function getReturnUrl($defaultUrl = null) {
		return parent::getReturnUrl($defaultUrl);
	}

	public function getState($key, $defaultValue = null) {
		return parent::getState($key, $defaultValue);
	}

	public function getStateKeyPrefix() {
		return parent::getStateKeyPrefix();
	}

	public function hasFlash($key) {
		return parent::hasFlash($key);
	}

	public function hasState($key) {
		return parent::hasState($key);
	}

	public function init() {
		parent::init();
	}

	protected function loadIdentityStates($states) {
		parent::loadIdentityStates($states);
	}

	public function login($identity, $duration = 0) {
		parent::login($identity, $duration);
	}

	public function loginRequired() {
		parent::loginRequired();
	}

	public function logout($destroySession = true) {
		parent::logout($destroySession);
	}

	protected function renewCookie() {
		parent::renewCookie();
	}

	protected function restoreFromCookie() {
		parent::restoreFromCookie();
	}

	protected function saveIdentityStates() {
		return parent::saveIdentityStates();
	}

	protected function saveToCookie($duration) {
		parent::saveToCookie($duration);
	}

	public function setFlash($key, $value, $defaultValue = null) {
		parent::setFlash($key, $value, $defaultValue);
	}

	public function setId($value) {
		parent::setId($value);
	}

	public function setName($value) {
		parent::setName($value);
	}

	public function setReturnUrl($value) {
		parent::setReturnUrl($value);
	}

	public function setState($key, $value, $defaultValue = null) {
		parent::setState($key, $value, $defaultValue);
	}

	public function setStateKeyPrefix($value) {
		parent::setStateKeyPrefix($value);
	}

	protected function updateAuthStatus() {
		parent::updateAuthStatus();
	}

	protected function updateFlash() {
		parent::updateFlash();
	}

}

?>
