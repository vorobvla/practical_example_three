<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

class CommentTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu CommentInterface
	 */
	public function setUp() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface');
		$this->object = new $class;
	}

	/**
	 * test getteru a setteru pro atribut id
	 */
	public function testId() {
		$this->_testGetterSetter('getId', 'setId');
	}

	/**
	 * test getteru a setteru pro atribut author
	 */
	public function testAuthor() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface');
		$user = new $class;

		$this->_testGetterSetter('getAuthor', 'setAuthor', $user);
	}

	/**
	 * test getteru a setteru pro atribut post
	 */
	public function testPost() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface');
		$post = new $class;

		$this->_testGetterSetter('getPost', 'setPost', $post);
	}

	/**
	 * test getteru a setteru pro atribut parent
	 */
	public function testParent() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface');
		$comment = new $class;

		$this->_testGetterSetter('getParent', 'setParent', $comment);
	}

	/**
	 * test getteru a setteru pro atribut text
	 */
	public function testText() {
		$this->_testGetterSetter('getText', 'setText');
	}

	/**
	 * test getteru a setteru pro atribut created
	 */
	public function testCreated() {
		$this->_testGetterSetter('getCreated', 'setCreated', new \DateTime);
	}

	/**
	 * test getteru a setteru pro atribut modified
	 */
	public function testModified() {
		$this->_testGetterSetter('getModified', 'setModified', new \DateTime);
	}

	/**
	 * test add/remove a gettru pro kolekci files
	 */
	public function testFile() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\FileInterface');
		$file = new $class;

		$this->_testAddRemove('addFile', 'removeFile', 'getFiles', $file);
	}

	/**
	 * test getteru a setteru pro atribut spam
	 */
	public function testSpam() {
		$this->_testGetterSetter('getSpam', 'setSpam');
	}
}