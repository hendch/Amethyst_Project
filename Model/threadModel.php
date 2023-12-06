<?php
class Thread
{
    protected string $title;
    protected int $user_id;
    protected string $created_at;
    protected string $username;
    protected int $views; 
    public function __construct(string $title, int $user_id, string $created_at, string $username, int $views = 0)
    {
        $this->title = $title;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->username = $username;
        $this->views = $views;
    }
    // Getters and setters for each property
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getViews()
    {
        return $this->views;
    }
    public function setViews($views)
    {
        $this->views = $views;
    }
}
?>