<?php

namespace App\Services;
use App\Services\Service;
use Illuminate\Contracts\Container\Container;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;



class ModelService extends Service
{
    protected Container $container;
	protected User $userService;
	protected Post $postService;
	protected Tag $tagService;

    public function __construct(Container $container)
	{

		$this->userService = $container->make(User::class);
		$this->postService = $container->make(Post::class);
		$this->tagService = $container->make(Tag::class);

    }

    public function userService()
	{
		return $this->userService;
	}

	public function postService()
	{
		return $this->postService;
	}

	public function tagService()
	{
		return $this->tagService;
	}
}