<?php

namespace App\Services;
use App\Services\Service;
use Illuminate\Contracts\Container\Container;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Media;
use App\Models\PostMeta;



class ModelService extends Service
{
    protected Container $container;
	protected User $userService;
	protected Post $postService;
	protected Tag $tagService;
	protected Media $mediaService;
	protected PostMeta $postMetaService;


    public function __construct(Container $container)
	{

		$this->userService = $container->make(User::class);
		$this->postService = $container->make(Post::class);
		$this->tagService = $container->make(Tag::class);
		$this->mediaService = $container->make(Media::class);
		$this->postMetaService = $container->make(PostMeta::class);
    }

    public function userService()
	{
		return $this->userService;
	}

	public function postService()
	{
		return $this->postService;
	}

	public function postMetaService()
	{
		return $this->postMetaService;
	}
	

	public function tagService()
	{
		return $this->tagService;
	}

	public function mediaService()
	{
		return $this->mediaService;
	}	

}