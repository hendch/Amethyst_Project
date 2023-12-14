<?php
require 'Config.php';
require '../../Model/threadModel.php';
class ThreadController
{
    public function getAllThreads($offset, $limit, $filter = null)
   {
       $db = Config::getConnexion();
   
       // Set a default filter if none is provided
       $filter = $filter ?? 'created_at';
   
       // Define an array of allowed filters to prevent SQL injection
       $allowedFilters = ['created_at', 'views', 'posts']; // Add other filters as needed
   
       // Validate the provided filter
       if (!in_array($filter, $allowedFilters)) {
           // Handle invalid filter (you can throw an exception, log an error, etc.)
           return [];
       }
   
       $orderBy = ($filter === 'posts') ? 'post_count' : $filter;
   
       $sql = "SELECT *, (SELECT COUNT(*) FROM posts WHERE thread_id = threads.thread_id) as post_count FROM threads ORDER BY $orderBy DESC LIMIT :offset, :limit";
   
       try {
           $query = $db->prepare($sql);
           $query->bindParam(':offset', $offset, PDO::PARAM_INT);
           $query->bindParam(':limit', $limit, PDO::PARAM_INT);
           $query->execute();
   
           return $query->fetchAll(PDO::FETCH_ASSOC);
       } catch (Exception $e) {
           echo 'Error: ' . $e->getMessage();
           return [];
       }
   }
    public function getThreadById($thread_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT * FROM threads WHERE thread_id = :thread_id";
        try {
            $query = $db->prepare($sql);
            $query->execute(['thread_id' => $thread_id]);
            $threadData = $query->fetch(PDO::FETCH_ASSOC);
            if ($threadData) {
                // Create an instance of the Thread class and return it
                return new Thread(
                    $threadData['title'],
                    $threadData['user_id'],
                    $threadData['created_at'],
                    $threadData['username'],
                    $threadData['views'] // Include views
                );
            } else {
                return null; // or handle the case where no thread is found
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
    public function timeAgo($timestamp)
    {
        $currentTime = time();
        $threadTime = strtotime($timestamp);
        $difference = $currentTime - $threadTime;
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
                return $quotient . ' ' . $unit . '';
            }
        }
        return 'just now';
    }
    public function getPosts($thread_id)
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
    public function addThread($thread)
    {
        $db = Config::getConnexion();
        $sql = "INSERT INTO threads (user_id, title, created_at, username, views)
    VALUES (:user_id, :title, :created_at, :username, :views)"; // Add 'views' column
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $thread->getTitle(),
                'user_id' => $thread->getUserId(),
                'created_at' => $thread->getCreatedAt(),
                'username' => $thread->getUsername(),
                'views' => $thread->getViews() // Include views
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function getPostCountByThread($thread_id)
    {
        $db = Config::getConnexion();
        $sql = "SELECT COUNT(*) as post_count FROM posts WHERE thread_id = :thread_id";
        try {
            $query = $db->prepare($sql);
            $query->execute(['thread_id' => $thread_id]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['post_count'] ?? 0;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    public function getTotalThreadsCount()
    {
        $db = Config::getConnexion();
        $sql = "SELECT COUNT(*) AS total FROM threads";
        try {
            $query = $db->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    public function incrementThreadViews($thread_id)
    {
        $db = Config::getConnexion();
        $sql = "UPDATE threads SET views = views + 1 WHERE thread_id = :thread_id";
        try {
            $query = $db->prepare($sql);
            $query->execute(['thread_id' => $thread_id]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function getRecentThreads($limit = 4)
    {
        $db = Config::getConnexion();
        $sql = "SELECT * FROM threads ORDER BY created_at DESC LIMIT :limit";
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':limit', $limit, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    public function getTotalTopicsCount()
    {
        $db = Config::getConnexion();
        $sql = "SELECT COUNT(*) AS total FROM threads";
        try {
            $query = $db->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    public function getTotalPostsCount()
    {
        $db = Config::getConnexion();
        $sql = "SELECT COUNT(*) AS total FROM posts";
        try {
            $query = $db->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    public function getTotalMembersCount()
    {
        $db = Config::getConnexion();
        $sql = "SELECT COUNT(DISTINCT user_id) AS total FROM threads";
        try {
            $query = $db->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }
    public function getNewestMember()
    {
        $db = Config::getConnexion();
        $sql = "SELECT username FROM threads ORDER BY created_at DESC LIMIT 1";
        try {
            $query = $db->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['username'] ?? '';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return '';
        }
    }
}
?>