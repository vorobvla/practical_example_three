<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Comment;
use Cvut\Fit\BiPwt\BlogBundle\Entity\File;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Tag;
use Cvut\Fit\BiPwt\BlogBundle\Entity\User;

class PostTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu PostInterface
	 */
	public function setUp() {
		$this->object = new Post();
	}

	/**
	 * test getteru a setteru pro atribut author
	 */
	public function testAuthor() {
		$user = new User();

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
		$file = new File();

		$this->_testAddRemove('addFile', 'removeFile', 'getFiles', 'getPost', $file);
	}

	/**
	 * test add/remove a gettru pro kolekci tags
	 */
	public function testTag() {
		$tag = new Tag();

		$this->_testAddRemove('addTag', 'removeTag', 'getTags', 'getPosts', $tag);
	}

	/**
	 * test add/remove a gettru pro kolekci comments
	 */
	public function testComment() {
		$comment = new Comment();

		$this->_testAddRemove('addComment', 'removeComment', 'getComments', 'getPost', $comment);
	}
}
