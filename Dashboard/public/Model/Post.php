<?php

require_once __DIR__ . "/model.php";


class Post extends Model
{

   protected $table = "posts";
   protected $primaryKey = "id_post";


   public function create($datas)
   {
      $namaFile = $datas['files']['attachment']['name'];
      $tmp_name = $datas['files']['attachment']['tmp_name'];
      $ekstensi_file = pathinfo($namaFile, PATHINFO_EXTENSION);
      $ekstensi_allowed = ['jpg', 'png', 'jpeg', 'JPG'];
      if (!in_array($ekstensi_file, $ekstensi_allowed)) {
         return "Ekstensi file tidak diijinkan";
      }

      if ($datas['files']['attachment']['size'] > 5000000) {
         return "Ukuran file harus kurang dari 5MB";
      }

      $namaFile = random_int(1000, 9999) . "." . $ekstensi_file;
      move_uploaded_file($tmp_name, "../assets/Public/Post/" . $namaFile);
      $datas = [
         "title" => mysqli_real_escape_string($this->db, $datas["post"]["title"] ?? ''),
         "content" => mysqli_real_escape_string($this->db, $datas["post"]["content"] ?? ''),
         "attachment" => $namaFile,
         "category_id" => $datas["post"]["category"] ?? null,
         "user_id" => $datas["post"]["user"] ?? null,
      ];


      parent::create_data($datas, $this->table);

      $tags = $_POST['tag_id_pivot'];
      if (empty($tags)) {
         die("Tag ID Pivot tidak ditemukan atau kosong.");
      };

      $last_id = mysqli_insert_id($this->db);
      foreach ($tags as $tag) {
         $query = "INSERT INTO pivot_posts_tags (post_id_pivot, tag_id_pivot) VALUES ('$last_id', $tag)";
         $result = $this->db->query($query);
         if ($result == false) {
            return "Failed to insert tag";
         }
      }
   }

   public function all()
   {
      return parent::all_data($this->table);
   }


   public function find($id)
   {
      return parent::find_data($id, $this->primaryKey, $this->table);
   }

   public function update($id, $datas)
   {
      if (empty($id)) {
         return "Invalid post ID";
      }

      $namaFile = $datas['files']['attachment']['name'] ?? null;
      $tmp_name = $datas['files']['attachment']['tmp_name'] ?? null;
      $ekstensi_allowed = ['jpg', 'png', 'jpeg'];

      if ($namaFile) {
         $ekstensi_file = pathinfo($namaFile, PATHINFO_EXTENSION);
         if (!in_array($ekstensi_file, $ekstensi_allowed)) {
            return "Ekstensi file tidak diijinkan";
         }

         if ($datas['files']['attachment']['size'] > 5000000) {
            return "Ukuran file harus kurang dari 5MB";
         }

         $namaFile = random_int(1000, 9999) . "." . $ekstensi_file;
         move_uploaded_file($tmp_name, "../assets/Public/Post/" . $namaFile);
      }

      // Sanitasi data untuk menghindari karakter spesial dalam SQL
      $title = mysqli_real_escape_string($this->db, $datas["post"]["title"] ?? '');
      $content = mysqli_real_escape_string($this->db, $datas["post"]["content"] ?? '');
      $existing_attachment = $datas["post"]["existing_attachment"] ?? null;
      $attachment = $namaFile ?? $existing_attachment;
      $category_id = $datas["post"]["category"] ?? null;
      $user_id = $datas["post"]["user"] ?? null;

      $updateData = [
         "title" => $title,
         "content" => $content,
         "attachment" => $attachment,
         "category_id" => $category_id,
         "user_id" => $user_id,
      ];

      // Update main table
      $updateResult = parent::update_data($id, $this->primaryKey, $updateData, $this->table);
      if (!$updateResult) {
         return "Failed to update post";
      }

      // Handle pivot table updates
      $tags = $datas['post']['tag_id_pivot'] ?? [];
      if (!empty($tags)) {
         $deleteQuery = "DELETE FROM pivot_posts_tags WHERE post_id_pivot = $id";
         if (!$this->db->query($deleteQuery)) {
            return "Failed to delete existing tags";
         }

         foreach ($tags as $tag) {
            $query = "INSERT INTO pivot_posts_tags (post_id_pivot, tag_id_pivot) VALUES ('$id', $tag)";
            if (!$this->db->query($query)) {
               return "Failed to insert tag";
            }
         }
      }
   }



   public function delete($id)
   {
      return parent::delete_data($id, $this->primaryKey, $this->table);
   }

   public function search($keyword, $start = null, $limit = null)
   {
      $queryLimit = '';
      if (isset($start) && isset($limit)) {
         $queryLimit = " LIMIT $start, $limit";
      }
      $keyword = " WHERE title LIKE '%{$keyword}%' $queryLimit";
      return parent::search_data($keyword, $this->table);
   }
   public function paginate($start, $limit)
   {
      return parent::paginate_data($this->table, $start, $limit);
   }

   public function all_2($start, $limit)
   {
      $query = "SELECT posts.title, posts.attachment, posts.content, categories.name_category, users.full_name, tags.name_tag, users.avatar  FROM posts JOIN categories ON posts.category_id = categories.id_category JOIN users ON users.id_user = posts.user_id JOIN pivot_posts_tags ON pivot_posts_tags.post_id_pivot = posts.id_post JOIN tags ON pivot_posts_tags.tag_id_pivot = tags.id_tag WHERE id_post = pivot_posts_tags.post_id_pivot  LIMIT $start, $limit";

      $result = mysqli_query($this->db, $query);
      return $this->convert_data($result);
   }

   public function all_3($start, $limit)
   {
      // ambil semua data post dengan semua tag yan ada di pivot_posts_tags
      $query = "SELECT posts.id_post, posts.title, posts.attachment, posts.content, categories.name_category, users.full_name, users.avatar, GROUP_CONCAT(tags.name_tag SEPARATOR ', ') AS tags FROM posts JOIN pivot_posts_tags ON posts.id_post = pivot_posts_tags.post_id_pivot JOIN tags ON pivot_posts_tags.tag_id_pivot = tags.id_tag JOIN categories ON posts.category_id = categories.id_category JOIN users ON posts.user_id = users.id_user WHERE posts.id_post = pivot_posts_tags.post_id_pivot GROUP BY posts.id_post, posts.title, posts.attachment, posts.content, categories.name_category, users.full_name, users.avatar LIMIT $start, $limit";
      $result = mysqli_query($this->db, $query);
      return $this->convert_data($result);
   }

   public function total_post(){
      // mengambil jumlah postingan
      $query = "SELECT COUNT(posts.id_post) AS total_posts FROM posts";
      $result = mysqli_query($this->db, $query);
      return $this->convert_data($result);
  }
}
