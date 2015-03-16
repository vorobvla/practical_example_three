<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Tag;

class TagTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu CommentInterface
	 */
	public function setUp() {
		$this->object = new Tag();
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
		$post = new Post();

		$this->_testAddRemove('addPost', 'removePost', 'getPosts', $post);
	}
}