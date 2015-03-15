<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

class UserTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu CommentInterface
	 */
	public function setUp() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface');
		$this->object = new $class;
	}

	/**
	 * test getteru a setteru pro atribut id
	 */
	public function testId() {
		$this->_testGetterSetter('getId', 'setId');
	}

	/**
	 * test getteru a setteru pro atribut name
	 */
	public function testName() {
		$this->_testGetterSetter('getName', 'setName');
	}


	/**
	 * test add/remove a gettru pro kolekci posts
	 */
	public function testPost() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface');
		$post = new $class;

		$this->_testAddRemove('addPost', 'removePost', 'getPosts', $post);
	}
}