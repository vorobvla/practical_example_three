<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Service;

use Cvut\Fit\BiPwt\BlogBundle\Exception\ItemNotFoundException;
use Doctrine\Common\Collections\Criteria;

class BlogServiceTest extends ServiceTestcase {

	/**
	 * @var string - implementace PostInterface
	 */
	protected $postClass;

	/**
	 * @var string - implementace TagInterface
	 */
	protected $tagClass;

	/**
	 * @var string - implementace CommentInterface
	 */
	protected $commentClass;

	/**
	 * @var string - implementace FileInterface
	 */
	protected $fileClass;

	/**
	 * @var object - implementace Service/UserInterface
	 */
	protected $userService;

	/**
	 * setup - vytvoreni instance podle interfacu UserInterface
	 */
	public function setUp() {
		global $interfaceToClassMap;
		global $em;

		$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\DependencyInjection\InterfaceToClassMap', $interfaceToClassMap, "Interface to class map object is invalid.");

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Service\BlogInterface');
		//FIXME parametry kontruktoru
		$this->service = new $class($interfaceToClassMap);
		//$this->service = new $class($em);

		$this->postClass = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\PostInterface');
		$this->tagClass = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\TagInterface');
		$this->commentClass = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\CommentInterface');
		$this->fileClass = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Entity\FileInterface');

		$class = $interfaceToClassMap->getClass('Cvut\Fit\BiPwt\BlogBundle\Service\UserInterface');
		//FIXME parametry kontruktoru
		$this->userService = new $class($interfaceToClassMap);
		//$this->userService = new $class($em);
	}

	/**
	 * pomocna metoda pro vytvoreni instance prispevku
	 * @return mixed
	 */
	protected function _newPost($id, $title, $text, $author) {
		$now = new \DateTime;
		$post = new $this->postClass;
		$post->setId($id);
		$post->setTitle($title);
		$post->setText($text);
		$post->setAuthor($author);
		$post->setCreated($now);
		$post->setModified($now);
		$post->setPublishFrom($now);
		$post->setPublishTo(new \DateTime('2020-12-31'));

		return $post;
	}

	/**
	 * pomocna metoda pro vytvoreni prispevku
	 * @param $id
	 * @param $title
	 * @return mixed
	 */
	protected function _createPost($id, $title, $text, $author) {
		$post = $this->_newPost($id, $title, $text, $author);
		$post2 = $this->service->createPost($post);
		$this->assertTrue($post === $post2, "'createPost' method doesn't return proper object.");

		return $post2;
	}

	/**
	 * pomocna metoda pro vytvoreni instance tag
	 * @return mixed
	 */
	protected function _newTag($id, $title) {
		$tag = new $this->tagClass;
		$tag->setId($id);
		$tag->setTitle($title);

		return $tag;
	}

	/**
	 * pomocna metoda pro vytvoreni tagu
	 * @param $id
	 * @param $title
	 * @return mixed
	 */
	protected function _createTag($id, $title) {
		$tag = $this->_newTag($id, $title);
		$tag2 = $this->service->createTag($tag);
		$this->assertTrue($tag === $tag2, "'createTag' method doesn't return proper object.");

		return $tag2;
	}

	/**
	 * pomocna metoda pro vytvoreni instance comment
	 * @return mixed
	 */
	protected function _newComment($id, $text, $author) {
		$now = new \DateTime;
		$comment = new $this->commentClass;
		$comment->setId($id);
		$comment->setText($text);
		$comment->setAuthor($author);
		$comment->setCreated($now);
		$comment->setModified($now);
		$comment->setSpam(FALSE);

		return $comment;
	}

	/**
	 * pomocna metoda pro vytvoreni instance file
	 * @return mixed
	 */
	protected function _newFile($id, $name) {
		$now = new \DateTime;
		$file = new $this->fileClass;
		$file->setId($id);
		$file->setName($name);
		$file->setData('dummy data');
		$file->setCreated($now);
		$file->setInternetMediaType('application/octet-stream');

		return $file;
	}

	/**
	 * test metody pro vytvoreni tagu
	 */
	public function testCreateTag() {
		$tag = $this->_createTag(1, 'diary');
		$tag2 = $this->service->findTag($tag->getId());
		$this->assertNotNull($tag2, "Created tag cannot be found.");
	}

	/**
	 * test metody pro aktualizaci tagu
	 */
	public function testUpdateTag() {
		$newVal = 'great ideas';
		$tag = $this->_createTag(2, 'ideas');
		$tag->setTitle($newVal);
		$tag2 = $this->service->updateTag($tag);
		$tag3 = $this->service->findTag($tag->getId());

		$this->assertTrue($tag == $tag2, "'updateTag' method doesn't return proper object.");
		$this->assertTrue($tag3->getTitle() == $newVal, "Tag title didn't change properly.");
	}

	/**
	 * test metody pro smazani tagu
	 */
	public function testDeleteTag() {
		$tag = $this->_createTag(3, 'work');
		$id = $tag->getId();
		$tag2 = $this->service->deleteTag($tag);

		$this->assertTrue($tag == $tag, "'deleteTag' method doesn't return proper object.");
		$this->assertInstanceOf($this->tagClass, $tag2, "'deleteTag' method doesn't return object of proper class.");

		try {
			$tag3 = $this->service->findTag($id);
			$this->assertNull($tag3, "Deleted tag still can be found.");
		} catch(\Exception $e) {}
	}

	/**
	 * test metody pro nalezeni tagu podle id
	 */
	public function testFindTag() {
		$tag = $this->_createTag(4, 'music');
		$id = $tag->getId();

		$tag2 = $this->service->findTag($id);

		$this->assertTrue($tag2->getId() == $id, "Tag ID is improper.");
		$this->assertTrue($tag2->getTitle() == $tag->getTitle(), "Tag name is improper.");

		$this->assertTrue($tag == $tag2, "'findTag' method doesn't return proper instance (equal).");
		$this->assertTrue($tag === $tag2, "'findTag' method doesn't return proper instance (identity).");
	}

	/**
	 * test metody pro nalezeni tagu podle kriterii
	 */
	public function testFindTagBy() {
		$data = [
			5 => 'movie',
			6 => 'demos',
			7 => 'art',
		];
		$collectionClass = 'Doctrine\Common\Collections\Collection';

		$newData = [];
		foreach($data as $id => $title) {
			$tag = $this->_createTag($id, $title);
			//vytvorime si zaznamy s novym id
			$newData[$tag->getId()] = $title;
		}

		//test na operator 'eq'
		$criteria = new Criteria;
		$title = 'games';
		$criteria->andWhere($criteria->expr()->eq('title', $title));

		$tags = $this->service->findTagBy($criteria);
		$this->assertInstanceOf($collectionClass, $tags, "'findTagBy' method doesn't return object of proper class.");

		foreach($tags as $tag2) {
			$this->assertInstanceOf($this->tagClass, $tag2, "Item isn't object of proper class.");
			$this->assertTrue($tag2->getTitle() == $title, "Tag title for item #{$id} is improper.");
		}

		//test na operator 'contains'
		$criteria = new Criteria;
		$str = 'mo';
		$criteria->andWhere($criteria->expr()->contains('title', $str));

		$tags = $this->service->findTagBy($criteria);
		$this->assertNotEmpty($tags, "Returned collection should not be empty.");
		$this->assertInstanceOf($collectionClass, $tags, "'findTagBy' method doesn't return object of proper class.");

		foreach($tags as $tag2) {
			$this->assertInstanceOf($this->tagClass, $tag2, "Item isn't object of proper class.");
			$this->assertTrue(strstr($tag2->getTitle(), $str) !== FALSE, "Item #{$id} doesn't fit criterion.");
		}
	}

	/**
	 * test metody pro vytvoreni prispevku
	 */
	public function testCreatePost() {
		$author = $this->userService->create(1,'Autor 1');
		$post = $this->_createPost(1, 'initial diary post', 'my dear diary...', $author);
		$post2 = $this->service->findPost($post->getId());
		$this->assertNotNull($post2, "Created post cannot be found.");
	}

	/**
	 * test metody pro aktualizaci prispevku
	 */
	public function testUpdatePost() {
		$author = $this->userService->create(2,'Autor II');
		$newTitle = 'diary post #2';
		$newAuthor = $this->userService->create(3,'Autor 3');
		$post = $this->_createPost(2, 'second diary post', 'once upon a time...', $author);
		$post->setTitle($newTitle);
		$post->setAuthor($newAuthor);
		$post2 = $this->service->updatePost($post);
		$post3 = $this->service->findPost($post->getId());

		$this->assertTrue($post == $post2, "'updatePost' method doesn't return proper object.");
		$this->assertTrue($post3->getTitle() == $newTitle, "Post title didn't change properly.");
		$this->assertTrue($post3->getAuthor() == $newAuthor, "Post author didn't change properly.");
	}

	/**
	 * test metody pro smazani prispevku
	 */
	public function testDeletePost() {
		$author = $this->userService->create(4,'Autor 4');
		$post = $this->_createPost(3, 'my favourite band', 'my favourite music band is...', $author);
		$id = $post->getId();
		$post2 = $this->service->deletePost($post);

		$this->assertTrue($post == $post, "'deletePost' method doesn't return proper object.");
		$this->assertInstanceOf($this->postClass, $post2, "'deletePost' method doesn't return object of proper class.");

		try {
			$post3 = $this->service->findPost($id);
			$this->assertNull($post3, "Deleted post still can be found.");
		} catch(\Exception $e) {}
	}

	/**
	 * test metody pro nalezeni prispevku podle id
	 */
	public function testFindPost() {
		$author = $this->userService->create(5,'Mr. Five');
		$post = $this->_createPost(4, 'my favourite artist', 'my favourite artist is...', $author);
		$id = $post->getId();

		$post2 = $this->service->findPost($id);

		$this->assertTrue($post2->getId() == $id, "Post ID is improper.");
		$this->assertTrue($post2->getTitle() == $post->getTitle(), "Post name is improper.");

		$this->assertTrue($post == $post2, "'findPost' method doesn't return proper instance (equal).");
		$this->assertTrue($post === $post2, "'findPost' method doesn't return proper instance (identity).");
	}

	/**
	 * test metody pro nalezeni prispevku podle kriterii
	 */
	public function testFindPostBy() {
		$author1 = $this->userService->create(6,'Blogger 6');
		$author2 = $this->userService->create(7,'Se7en');
		$data = [
			5 => ['sample post title 5', 'sample post content text...', $author1],
			6 => ['another post title', 'text text text', $author2],
			7 => ['dummy post title', 'this is dummy post', $author1]
		];
		$collectionClass = 'Doctrine\Common\Collections\Collection';

		$newData = [];
		foreach($data as $id => $item) {
			list($title, $text, $author) = $item;
			$post = $this->_createPost($id, $title, $text, $author);
			//vytvorime si zaznamy s novym id
			$newData[$post->getId()] = $item;
		}

		//test na operator 'eq'
		$criteria = new Criteria;
		$title = 'sample post title 5';
		$criteria->andWhere($criteria->expr()->eq('title', $title));

		$posts = $this->service->findPostBy($criteria);
		$this->assertInstanceOf($collectionClass, $posts, "'findPostBy' method doesn't return object of proper class.");

		foreach($posts as $post2) {
			$this->assertInstanceOf($this->postClass, $post2, "Item isn't object of proper class.");
			$this->assertTrue($post2->getTitle() == $title, "Post title for item #{$id} is improper.");
		}

		//test na operator 'contains'
		$criteria = new Criteria;
		$str = 'dummy';
		$criteria->andWhere($criteria->expr()->contains('text', $str));

		$posts = $this->service->findPostBy($criteria);
		$this->assertNotEmpty($posts, "Returned collection should not be empty.");
		$this->assertInstanceOf($collectionClass, $posts, "'findpostBy' method doesn't return object of proper class.");

		foreach($posts as $post2) {
			$this->assertInstanceOf($this->postClass, $post2, "Item isn't object of proper class.");
			$this->assertTrue(strstr($post2->getText(), $str) !== FALSE, "Item #{$id} doesn't fit criterion.");
		}
	}

	/**
	 * test metody pro pridani komentare
	 */
	public function testAddComment() {
		$author = $this->userService->create(8,'Author 8');
		$guest = $this->userService->create(9,'Guest');

		$post = $this->_createPost(8, 'post number eight', 'this day was...', $author);
		$comment = $this->_newComment(1, 'like +8', $guest);

		$post2 = $this->service->addComment($post, $comment);
		$this->assertTrue($post == $post2, "'addComment' method returns different post.");

		$comment3 = NULL;
		foreach($post->getComments() as $comment2) {
			if($comment2->getId() == $comment->getId()) {
				$comment3 = $comment2;
				break;
			}
		}

		$this->assertNotNull($comment3, "Added comment cannot be found.");
		$this->assertTrue($comment == $comment3, "Added comment differs.");
		$this->assertTrue($comment3->getPost() == $post, "Added comment doesn't refer to post");
	}

	/**
	 * test metody pro smazani komentare
	 */
    public function testDeleteComment() {
	    $author = $this->userService->create(10,'Author 10');
	    $guest = $this->userService->create(11,'AdBot');

	    $post = $this->_createPost(9, 'post number nine', "thanks god it's friday...", $author);
	    $comment = $this->_newComment(2, 'buy new pills!', $guest);

	    $this->service->addComment($post, $comment);

	    $post2 = $this->service->deleteComment($comment);
	    $this->assertTrue($post == $post2, "'deleteComment' method returns different post.");

	    foreach($post->getComments() as $comment2) {
		    $this->assertFalse($comment2->getId() == $comment->getId(), "Deleted comment still can be found.");
	    }
    }

	/**
	 * test metody pro pridani souboru
	 */
    public function testAddPostFile() {
	    $author = $this->userService->create(10,'Author 10');

	    $post = $this->_createPost(10, 'post number ten', 'we wish you merry christmas...', $author);
	    $file = $this->_newFile(1, 'pills.xls');

	    $post2 = $this->service->addPostFile($file, $post);
	    $this->assertTrue($post == $post2, "'addFile' method returns different post.");

	    $file3 = NULL;
	    foreach($post->getFiles() as $file2) {
		    if($file2->getId() == $file->getId()) {
			    $file3 = $file2;
			    break;
		    }
	    }

	    $this->assertNotNull($file3, "Added file cannot be found.");
	    $this->assertTrue($file == $file3, "Added file differs.");
	    $this->assertTrue($file3->getPost() == $post, "Added file doesn't refer to post");
    }

	/**
	 * test metody pro smazani souboru
	 */
    public function testDeleteFile() {
	    $author = $this->userService->create(11,'Author XI');

	    $post = $this->_createPost(11, 'post number XI', "thanks got it's not monday...", $author);
	    $file = $this->_newFile(2, 'new_pills.pdf.exe');

	    $this->service->addPostFile($file, $post);

	    $post2 = $this->service->deleteFile($file);
	    $this->assertTrue($post == $post2, "'deleteFile' method returns different post.");

	    foreach($post->getfiles() as $file2) {
		    $this->assertFalse($file2->getId() == $file->getId(), "Deleted file still can be found.");
	    }
    }
}