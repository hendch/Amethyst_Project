<?php

class Comment
{
    protected int $userId;
    protected string $username;
    protected int $postId;
    protected string $commentText;
    protected string $createdAt;

    public function __construct(int $userId, string $username, int $postId, string $commentText, string $createdAt)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->postId = $postId;
        $this->commentText = $commentText;
        $this->createdAt = $createdAt;
    }

    // Getters and setters for each property

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getCommentText(): string
    {
        return $this->commentText;
    }

    public function setCommentText(string $commentText): void
    {
        $this->commentText = $commentText;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
