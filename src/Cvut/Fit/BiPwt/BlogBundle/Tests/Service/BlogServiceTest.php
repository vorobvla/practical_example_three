<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Service;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Comment;
use Cvut\Fit\BiPwt\BlogBundle\Entity\File;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Tag;
use Cvut\Fit\BiPwt\BlogBundle\Service\BlogInterface;
use Cvut\Fit\BiPwt\BlogBundle\Service\UserInterface;
use Doctrine\Common\Collections\Criteria;

class BlogServiceTest extends ServiceTestcase {

	/** @var BlogInterface - implementace Service/BlogInterface */
	protected $service;

	/** @var UserInterface - implementace Service/UserInterface */
	protected $userService;

	/** @var int $postId - pocitadlo uzivatelu */
	protected static $userId = 1;

	/** @var int $postId - pocitadlo prispevku */
	protected static $postId = 1;

	/** @var int $postId - pocitadlo tagu */
	protected static $tagId = 1;

	/** @var int $postId - pocitadlo komentaru */
	protected static $commentId = 1;

	/** @var int $postId - pocitadlo souboru */
	protected static $fileId = 1;

	/**
	 * setup - vytvoreni instance podle interfacu UserInterface
	 */
	public function setUp() {
		$client = static::createClient();
		$container = $client->getContainer();

		$this->service = $container->get('cvut_fit_ict_bipwt_blog_service');

		$this->userService = $container->get('cvut_fit_ict_bipwt_user_service');
	}

	/**
	 * pomocna metoda pro vytvoreni instance prispevku
	 * @param $title
	 * @param $text
	 * @param $author
	 * @return Post
	 */
	protected function _newPost($title, $text, $author) {
		$now = new \DateTime;
		$post = new Post();
		$post->setId(self::$postId++);
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
	 * @param $title
	 * @param $text
	 * @param $author
	 * @return Post
	 */
	protected function _createPost($title, $text, $author) {
		$post = $this->_newPost($title, $text, $author);
		$post2 = $this->service->createPost($post);
		$this->assertTrue($post === $post2, "'createPost' method doesn't return proper object.");

		return $post2;
	}

	/**
	 * pomocna metoda pro vytvoreni instance tag
	 * @param $title
	 * @return Tag
	 */
	protected function _newTag($title) {
		$tag = new Tag();
		$tag->setId(self::$tagId++);
		$tag->setTitle($title);

		return $tag;
	}

	/**
	 * pomocna metoda pro vytvoreni tagu
	 * @param $title
	 * @return Tag
	 */
	protected function _createTag($title) {
		$tag = $this->_newTag($title);
		$tag2 = $this->service->createTag($tag);
		$this->assertTrue($tag === $tag2, "'createTag' method doesn't return proper object.");

		return $tag2;
	}

	/**
	 * pomocna metoda pro vytvoreni instance comment
	 * @param $text
	 * @param $author
	 * @return mixed
	 */
	protected function _newComment($text, $author) {
		$now = new \DateTime;
		$comment = new Comment();
		$comment->setId(self::$commentId++);
		$comment->setText($text);
		$comment->setAuthor($author);
		$comment->setCreated($now);
		$comment->setModified($now);
		$comment->setSpam(FALSE);

		return $comment;
	}

	/**
	 * pomocna metoda pro vytvoreni instance file
	 * @param $name
	 * @return mixed
	 */
	protected function _newFile($name) {
		$now = new \DateTime;
		$file = new File();
		$file->setId(self::$fileId++);
		$file->setName($name);
		$file->setData('dummy data');
		$file->setCreated($now);
		$file->setInternetMediaType('application/octet-stream');

		return $file;
	}

	/**
	 * pomocna metoda pro vytvoreni uzivatele
	 * @param $name
	 * @return \Cvut\Fit\BiPwt\BlogBundle\Entity\UserInterface
	 */
	protected function _createUser($name) {
		return $this->userService->create(self::$userId++, $name);
	}

	/**
	 * test metody pro vytvoreni tagu
	 */
	public function testCreateTag() {
		$tag = $this->_createTag('diary');
		$tag2 = $this->service->findTag($tag->getId());
		$this->assertNotNull($tag2, "Created tag cannot be found.");
	}

	/**
	 * test metody pro aktualizaci tagu
	 */
	public function testUpdateTag() {
		$newVal = 'great ideas';
		$tag = $this->_createTag('ideas');
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
		$tag = $this->_createTag('work');
		$id = $tag->getId();
		$tag2 = $this->service->deleteTag($tag);

		$this->assertTrue($tag == $tag, "'deleteTag' method doesn't return proper object.");
		$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\Tag', $tag2, "'deleteTag' method doesn't return object of proper class.");

		try {
			$tag3 = $this->service->findTag($id);
			$this->assertNull($tag3, "Deleted tag still can be found.");
		} catch(\Exception $e) {}
	}

	/**
	 * test metody pro nalezeni tagu podle id
	 */
	public function testFindTag() {
		$tag = $this->_createTag('music');
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
			'movie',
			'demos',
			'art',
		];
		$collectionClass = 'Doctrine\Common\Collections\Collection';

		$newData = [];
		foreach($data as $title) {
			$tag = $this->_createTag($title);
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
			$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\Tag', $tag2, "Item isn't object of proper class.");
			$this->assertTrue($tag2->getTitle() == $title, "Tag title for item #{$tag2->getId()} is improper.");
		}

		//test na operator 'contains'
		$criteria = new Criteria;
		$str = 'mo';
		$criteria->andWhere($criteria->expr()->contains('title', $str));

		$tags = $this->service->findTagBy($criteria);
		$this->assertNotEmpty($tags, "Returned collection should not be empty.");
		$this->assertInstanceOf($collectionClass, $tags, "'findTagBy' method doesn't return object of proper class.");

		foreach($tags as $tag2) {
			$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\Tag', $tag2, "Item isn't object of proper class.");
			$this->assertTrue(strstr($tag2->getTitle(), $str) !== FALSE, "Item #{$tag2->getId()} doesn't fit criterion.");
		}
	}

	/**
	 * test metody pro nalezeni vsech tagu
	 */
	public function testFindAllTags() {
		$data = [
			'movie',
			'demos',
			'art',
		];
		$collectionClass = 'Doctrine\Common\Collections\Collection';

		$newData = [];
		foreach($data as $title) {
			$tag = $this->_createTag($title);
			//vytvorime si zaznamy s novym id
			$newData[$tag->getId()] = $title;
		}

		//test
		$tags = $this->service->findAllTags();
		$this->assertInstanceOf($collectionClass, $tags, "'findAllTags' method doesn't return object of proper class.");
		$this->assertTrue(count($tags) >= count($newData),"'findAllTags' method doesn't return enough items.");

		foreach($tags as $tag2) {
			$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\Tag', $tag2, "Item isn't object of proper class.");
		}
	}

	/**
	 * test metody pro vytvoreni prispevku
	 */
	public function testCreatePost() {
		$author = $this->_createUser('Autor 1');
		$post = $this->_createPost('initial diary post', 'my dear diary...', $author);
		$post2 = $this->service->findPost($post->getId());
		$this->assertNotNull($post2, "Created post cannot be found.");
	}

	/**
	 * test metody pro aktualizaci prispevku
	 */
	public function testUpdatePost() {
		$author = $this->_createUser('Autor II');
		$newTitle = 'diary post #2';
		$newAuthor = $this->_createUser('Autor 3');
		$tag = $this->_createTag('used tag');

		$post = $this->_createPost('second diary post', 'once upon a time...', $author);
		$post->setTitle($newTitle);
		$post->setAuthor($newAuthor);
		$post->addTag($tag);
		$post2 = $this->service->updatePost($post);
		$post3 = $this->service->findPost($post->getId());

		$this->assertTrue($post == $post2, "'updatePost' method doesn't return proper object.");
		$this->assertTrue($post3->getTitle() == $newTitle, "Post title didn't change properly.");
		$this->assertTrue($post3->getAuthor() == $newAuthor, "Post author didn't change properly.");
		$this->assertTrue($post3->getTags()->contains($tag), "Post isn't tagged properly.");
	}

	/**
	 * test metody pro smazani prispevku
	 */
	public function testDeletePost() {
		$author = $this->_createUser('Autor 4');
		$post = $this->_createPost('my favourite band', 'my favourite music band is...', $author);
		$id = $post->getId();
		$post2 = $this->service->deletePost($post);

		$this->assertTrue($post == $post, "'deletePost' method doesn't return proper object.");
		$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\Post', $post2, "'deletePost' method doesn't return object of proper class.");

		try {
			$post3 = $this->service->findPost($id);
			$this->assertNull($post3, "Deleted post still can be found.");
		} catch(\Exception $e) {}
	}

	/**
	 * test metody pro nalezeni prispevku podle id
	 */
	public function testFindPost() {
		$author = $this->_createUser('Mr. Five');
		$post = $this->_createPost('my favourite artist', 'my favourite artist is...', $author);
		$id = $post->getId();

		$post2 = $this->service->findPost($id);

		$this->assertTrue($post2->getId() == $id, "Post ID is improper.");
		$this->assertTrue($post2->getTitle() == $post->getTitle(), "Post name is improper.");

		$this->assertTrue($post == $post2, "'findPost' method doesn't return proper instance (equal).");
		$this->assertTrue($post === $post2, "'findPost' method doesn't return proper instance (identity).");
	}

	/**
	 * test metody pro nalezeni vsech prispevku
	 */
	public function testFindAllPosts() {
		$author1 = $this->_createUser('Blogger 6');
		$author2 = $this->_createUser('Se7en');
		$data = [
			['sample post title 5', 'sample post content text...', $author1],
			['another post title', 'text text text', $author2],
			['dummy post title', 'this is dummy post', $author1]
		];
		$collectionClass = 'Doctrine\Common\Collections\Collection';

		$newData = [];
		foreach($data as $item) {
			list($title, $text, $author) = $item;
			$post = $this->_createPost($title, $text, $author);
			//vytvorime si zaznamy s novym id
			$newData[$post->getId()] = $item;
		}

		//test
		$posts = $this->service->findAllPosts();
		$this->assertInstanceOf($collectionClass, $posts, "'findAllPosts' method doesn't return object of proper class.");
		$this->assertTrue(count($posts) >= count($newData), "'findAllPosts' method doesn't return enough items.");

		foreach($posts as $post2) {
			$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\Post', $post2, "Item isn't object of proper class.");
		}
	}

	/**
	 * test metody pro nalezeni prispevku podle kriterii
	 */
	public function testFindPostBy() {
		$author1 = $this->_createUser('Blogger 6');
		$author2 = $this->_createUser('Se7en');
		$data = [
			['sample post title 5', 'sample post content text...', $author1],
			['another post title', 'text text text', $author2],
			['dummy post title', 'this is dummy post', $author1]
		];
		$collectionClass = 'Doctrine\Common\Collections\Collection';

		$newData = [];
		foreach($data as $item) {
			list($title, $text, $author) = $item;
			$post = $this->_createPost($title, $text, $author);
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
			$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\Post', $post2, "Item isn't object of proper class.");
			$this->assertTrue($post2->getTitle() == $title, "Post title for item #{$post2->getId()} is improper.");
		}

		//test na operator 'contains'
		$criteria = new Criteria;
		$str = 'dummy';
		$criteria->andWhere($criteria->expr()->contains('text', $str));

		$posts = $this->service->findPostBy($criteria);
		$this->assertNotEmpty($posts, "Returned collection should not be empty.");
		$this->assertInstanceOf($collectionClass, $posts, "'findpostBy' method doesn't return object of proper class.");

		foreach($posts as $post2) {
			$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\Post', $post2, "Item isn't object of proper class.");
			$this->assertTrue(strstr($post2->getText(), $str) !== FALSE, "Item #{$post2->getId()} doesn't fit criterion.");
		}
	}

	/**
	 * test metody pro pridani komentare
	 */
	public function testAddComment() {
		$author = $this->_createUser('Author 8');
		$guest = $this->_createUser('Guest');

		$post = $this->_createPost('post number eight', 'this day was...', $author);
		$comment = $this->_newComment('like +8', $guest);

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
	    $author = $this->_createUser('Author 10');
	    $guest = $this->_createUser('AdBot');

	    $post = $this->_createPost('post number nine', "thanks god it's friday...", $author);
	    $comment = $this->_newComment('buy new pills!', $guest);

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
	    $author = $this->_createUser('Author 10');

	    $post = $this->_createPost('post number ten', 'we wish you merry christmas...', $author);
	    $file = $this->_newFile('pills.xls');

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
	    $author = $this->_createUser('Author XI');

	    $post = $this->_createPost('post number XI', "thanks got it's not monday...", $author);
	    $file = $this->_newFile('new_pills.pdf.exe');

	    $this->service->addPostFile($file, $post);

	    $post2 = $this->service->deleteFile($file);
	    $this->assertTrue($post == $post2, "'deleteFile' method returns different post.");

	    foreach($post->getFiles() as $file2) {
		    $this->assertFalse($file2->getId() == $file->getId(), "Deleted file still can be found.");
	    }
    }
}
