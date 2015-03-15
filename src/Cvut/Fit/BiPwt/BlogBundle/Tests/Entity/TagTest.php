<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

class TagTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu CommentInterface
	 */
	public function setUp() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\TagInterface');
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
	public function testTitle() {
		$this->_testGetterSetter('getTitle', 'setTitle');
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