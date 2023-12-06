<?php
require_once 'Config.php';
require '../../Model/postModel.php';
require '../../Model/CommentModel.php';
require '../../Model/replyModel.php';

class PostController
{
    public function addPost($post)
    {
        $db = Config::getConnexion();

        // Fetch the user_id and username from the session
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];

        $sql = "INSERT INTO posts (user_id, thread_id, title, content, created_at, username) VALUES (:user_id, :thread_id, :title, :content, :created_at, :username)";

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $user_id,
                'thread_id' => $post->getThreadId(),
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'created_at' => $post->getCreatedAt(),
                'username' => $username,
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function getPostById($post_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT p.*, u.username FROM posts p
                JOIN users u ON p.user_id = u.user_id
                WHERE p.post_id = :post_id";

        try {
            $query = $db->prepare($sql);
            $query->execute(['post_id' => $post_id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
    public function getComments($post_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at ASC";

        try {
            $query = $db->prepare($sql);
            $query->execute(['post_id' => $post_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    // Add a new method to fetch the username based on user_id
    private function getUsernameById($user_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT username FROM users WHERE user_id = :user_id";

        try {
            $query = $db->prepare($sql);
            $query->execute(['user_id' => $user_id]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result['username'] ?? null;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    public function getAllPosts($thread_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT * FROM posts WHERE thread_id = :thread_id ORDER BY created_at ASC";

        try {
            $query = $db->prepare($sql);
            $query->execute(['thread_id' => $thread_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function timeAgo($timestamp)
    {
        $currentTime = time();
        $postTime = strtotime($timestamp);
        $difference = $currentTime - $postTime;

        $intervals = array(
            'year' => 31536000,
            'month' => 2592000,
            'week' => 604800,
            'day' => 86400,
            'hour' => 3600,
            'minute' => 60
        );

        foreach ($intervals as $interval => $seconds) {
            $quotient = floor($difference / $seconds);

            if ($quotient >= 1) {
                $unit = $quotient == 1 ? $interval : $interval . 's';
                return $quotient . ' ' . $unit . ' ago';
            }
        }

        return 'just now';
    }
    public function addComment($comment)
    {
        $db = Config::getConnexion();

        $sql = "INSERT INTO comments (user_id, username, post_id, comment_text, created_at) 
                VALUES (:user_id, :username, :post_id, :comment_text, :created_at)";

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $comment->getUserId(),
                'username' => $comment->getUsername(),
                'post_id' => $comment->getPostId(),
                'comment_text' => $comment->getCommentText(),
                'created_at' => $comment->getCreatedAt(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function addReply(Reply $reply)
    {
        $db = Config::getConnexion();

        // Ensure that user_id and username are fetched from the session
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];

        $sql = "INSERT INTO replies (user_id, comment_id, username, reply_text, created_at) 
                VALUES (:user_id, :comment_id, :username, :reply_text, :created_at)";

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $user_id,
                'comment_id' => $reply->getCommentId(),
                'username' => $reply->getUsername(),
                'reply_text' => $reply->getReplyText(),
                'created_at' => $reply->getCreatedAt(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getReplies($comment_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT * FROM replies WHERE comment_id = :comment_id ORDER BY created_at ASC";

        try {
            $query = $db->prepare($sql);
            $query->execute(['comment_id' => $comment_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    public function getCommentCountByPost($post_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT COUNT(*) as comment_count FROM comments WHERE post_id = :post_id";

        try {
            $query = $db->prepare($sql);
            $query->execute(['post_id' => $post_id]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result['comment_count'] ?? 0;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    public function getPostsByDate($thread_id, $selected_date)
    {
        $db = Config::getConnexion();
        $sql = "SELECT * FROM posts WHERE thread_id = :thread_id AND DATE(created_at) = :selected_date ORDER BY created_at ASC";

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'thread_id' => $thread_id,
                'selected_date' => $selected_date,
            ]);

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    public function getDatesWithPosts($thread_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT DISTINCT DATE_FORMAT(created_at, '%Y-%m-%d') as post_date 
            FROM posts 
            WHERE thread_id = :thread_id 
            ORDER BY post_date ASC";

        try {
            $query = $db->prepare($sql);
            $query->execute(['thread_id' => $thread_id]);

            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $datesWithPosts = array_map(function ($item) {
                return $item['post_date'];
            }, $result);

            return $datesWithPosts;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }



}
?>