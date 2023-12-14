<?php

class Post
{
    protected int $user_id;
    protected int $thread_id;
    protected string $title; 
    protected string $content;
    protected string $created_at;

    public function __construct(int $user_id, int $thread_id, string $title, string $content, string $created_at)
    {
        $this->user_id = $user_id;
        $this->thread_id = $thread_id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
    }

    // Getters and setters for each property

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getThreadId()
    {
        return $this->thread_id;
    }

    public function setThreadId($thread_id)
    {
        $this->thread_id = $thread_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
}
