<?php

require_once __DIR__ . '/../../Dashboard/Public/Model/Model.php';

class Blogs_new extends Model
{
    protected $table = "p";

    public function all_new($start, $limit)
    {
        $query = "SELECT * FROM posts JOIN categories ON posts.category_id = categories.id_category JOIN users ON posts.user_id = users.id_user LIMIT $start, $limit";

        $result = mysqli_query($this->db, $query);

        return $this->convert_data($result);
    }

    public function find_blog($id)
    {
        // Query dengan parameterized statement
        $query = "SELECT posts.id_post, posts.title, posts.attachment, posts.content, posts.created_at_post, categories.name_category, users.full_name, users.avatar, users.email, GROUP_CONCAT(tags.name_tag SEPARATOR ', ') AS tags 
              FROM posts 
              JOIN pivot_posts_tags ON posts.id_post = pivot_posts_tags.post_id_pivot 
              JOIN tags ON pivot_posts_tags.tag_id_pivot = tags.id_tag 
              JOIN categories ON posts.category_id = categories.id_category 
              JOIN users ON posts.user_id = users.id_user 
              WHERE posts.id_post = ? 
              GROUP BY posts.id_post, posts.title, posts.attachment, posts.content, posts.created_at_post, categories.name_category, users.full_name, users.avatar ORDER BY posts.created_at_post DESC";
        // Prepare statement
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $this->convert_data($result);
    }

    public function blog_author($id, $limit)
    {
        $query = "SELECT posts.*, users.* FROM posts JOIN users ON posts.user_id = users.id_user WHERE users.id_user = $id ORDER BY posts.created_at_post DESC LIMIT $limit";
        $result = mysqli_query($this->db, $query);
        return $this->convert_data($result);
    }

    public function blog_category($id, $limit)
    {
        $query = "SELECT posts.*, categories.* FROM posts JOIN categories ON posts.category_id = categories.id_category WHERE categories.id_category = $id  ORDER BY posts.created_at_post DESC LIMIT $limit";
        $result = mysqli_query($this->db, $query);
        return $this->convert_data($result);
    }
}
