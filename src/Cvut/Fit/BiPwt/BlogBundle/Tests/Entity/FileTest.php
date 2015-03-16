<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Comment;
use Cvut\Fit\BiPwt\BlogBundle\Entity\File;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;

class FileTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu FileInterface
	 */
	public function setUp() {
		$this->object = new File();
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
	 * test getteru a setteru pro atribut post
	 */
	public function testPost() {
		$post = new Post();

		$this->_testGetterSetter('getPost', 'setPost', $post);
	}

	/**
	 * test getteru a setteru pro atribut created
	 */
	public function testCreated() {
		$this->_testGetterSetter('getCreated', 'setCreated', new \DateTime);
	}

	/**
	 * test getteru a setteru pro atribut data
	 */
	public function testData() {
		$this->_testGetterSetter('getData', 'setData');
	}

	/**
	 * test getteru a setteru pro atribut internetMediaType
	 */
	public function testInternetMediaType() {
		$this->_testGetterSetter('getInternetMediaType', 'setInternetMediaType');
	}

	/**
	 * test getteru a setteru pro atribut comment
	 */
	public function testComment() {
		$comment = new Comment();

		$this->_testGetterSetter('getComment', 'setComment', $comment);
	}
}