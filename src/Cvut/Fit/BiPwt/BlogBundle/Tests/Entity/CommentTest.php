<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Comment;
use Cvut\Fit\BiPwt\BlogBundle\Entity\File;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;
use Cvut\Fit\BiPwt\BlogBundle\Entity\User;

class CommentTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu CommentInterface
	 */
	public function setUp() {
		$this->object = new Comment();
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
		$user = new User();

		$this->_testGetterSetter('getAuthor', 'setAuthor', $user);
	}

	/**
	 * test getteru a setteru pro atribut post
	 */
	public function testPost() {
		$post = new Post();

		$this->_testGetterSetter('getPost', 'setPost', $post);
	}

	/**
	 * test getteru a setteru pro atribut parent
	 */
	public function testParent() {
		$comment = new Comment();

		$this->_testGetterSetter('getParent', 'setParent', $comment);
	}

	/**
	 * test add/remove a gettru pro kolekci children
	 */
	public function testChildren() {
		$comment = new Comment();

		$this->_testAddRemove('addChild', 'removeChild', 'getChildren', 'getParent', $comment);
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
		$file = new File();

		$this->_testAddRemove('addFile', 'removeFile', 'getFiles', 'getComment', $file);
	}

	/**
	 * test getteru a setteru pro atribut spam
	 */
	public function testSpam() {
		$this->_testGetterSetter('getSpam', 'setSpam');
	}
}