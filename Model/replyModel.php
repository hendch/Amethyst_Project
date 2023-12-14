<?php

class Reply
{
    protected int $userId;
    protected int $commentId;
    protected string $username;
    protected string $replyText;
    protected string $createdAt;

    public function __construct(int $userId, int $commentId, string $username, string $replyText, string $createdAt)
    {
        $this->userId = $userId;
        $this->commentId = $commentId;
        $this->username = $username;
        $this->replyText = $replyText;
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

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function setCommentId(int $commentId): void
    {
        $this->commentId = $commentId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getReplyText(): string
    {
        return $this->replyText;
    }

    public function setReplyText(string $replyText): void
    {
        $this->replyText = $replyText;
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
