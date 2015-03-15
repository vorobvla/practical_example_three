<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

class PostTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu PostInterface
	 */
	public function setUp() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface');
		$this->object = new $class;
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
	 * test getteru a setteru pro atribut author
	 */
	public function testCreated() {
		$this->_testGetterSetter('getCreated', 'setCreated', new \DateTime);
	}

	/**
	 * test getteru a setteru pro atribut id
	 */
	public function testId() {
		$this->_testGetterSetter('getId', 'setId');
	}

	/**
	 * test getteru a setteru pro atribut modified
	 */
	public function testModified() {
		$this->_testGetterSetter('getModified', 'setModified', new \DateTime);
	}

	/**
	 * test getteru a setteru pro atribut private
	 */
	public function testPrivate() {
		$this->_testGetterSetter('getPrivate', 'setPrivate');
	}

	/**
	 * test getteru a setteru pro atribut publishFrom
	 */
	public function testPublishFrom() {
		$this->_testGetterSetter('getPublishFrom', 'setPublishFrom', new \DateTime);
	}

	/**
	 * test getteru a setteru pro atribut publishTo
	 */
	public function testPublishTo() {
		$this->_testGetterSetter('getPublishTo', 'setPublishTo', new \DateTime);
	}

	/**
	 * test getteru a setteru pro atribut text
	 */
	public function testText() {
		$this->_testGetterSetter('getText', 'setText');
	}
	/**
	 * test getteru a setteru pro atribut title
	 */
	public function testTitle() {
		$this->_testGetterSetter('getTitle', 'setTitle');
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
	 * test add/remove a gettru pro kolekci tags
	 */
	public function testTag() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\TagInterface');
		$tag = new $class;

		$this->_testAddRemove('addTag', 'removeTag', 'getTags', $tag);
	}

	/**
	 * test add/remove a gettru pro kolekci comments
	 */
	public function testComment() {
		global $interfaceToClassMap;

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface');
		$comment = new $class;

		$this->_testAddRemove('addComment', 'removeComment', 'getComments', $comment);
	}
}
