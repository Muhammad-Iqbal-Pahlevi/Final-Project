<?php


require_once __DIR__ . "/model.php";


class Users extends Model
{

   protected $table = "users";
   protected $primaryKey = "id_user";

   public function create($datas)
   {
      return parent::create_data($datas, $this->table);
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
      return parent::update_data($id, $this->primaryKey, $datas, $this->table);
   }

   public function delete($id)
   {
      return parent::delete_data($id, $this->primaryKey, $this->table);
   }

   public function register($datas)
   {
      $name = $datas['post']["full_name"];
      $gender = $datas['post']['gender'];
      $email = $datas['post']['email'];
      $password = $datas['post']['password'];
      $phone = $datas['post']['phone'];
      $bio = $datas['post']['bio'];

      $query = "SELECT * FROM {$this->table} WHERE email = '$email'";
      $result = mysqli_query($this->db, $query);
      if (mysqli_num_rows($result) > 0) {
         return "Email already exists";
      }

      $namaFile = $datas['files']['avatar']["name"];
      $tmp_name = $datas['files']['avatar']['tmp_name'];
      $ekstensi_file = pathinfo($namaFile, PATHINFO_EXTENSION);
      $ekstensi_allowed = ['jpg', 'png', 'jpeg', 'gif', 'raw'];
      if (!in_array($ekstensi_file, $ekstensi_allowed)) {
         return "Ekstensi file tidak diijinkan";
      }

      if ($datas['files']['avatar']['size'] > 5000000) {
         return "Ukuran file harus kurang dari 5MB";
      }

      $namaFile = random_int(1000, 9999) . "." . $ekstensi_file;
      move_uploaded_file($tmp_name, "../assets/Public/Users/" . $namaFile);
      $password = base64_encode($password);
      $query_register = "INSERT INTO $this->table  (full_name, password, email, bio, gender, avatar, phone) VALUES ('$name',  '$password', '$email', '$bio', '$gender', '$namaFile', '$phone')";
      $result = mysqli_query($this->db, $query_register);
      if ($result == false) {
         return "Failed to register";
      }


      // return  $this->login($email, $password);
   }

   public function login($email, $password)
   {

      $query = "SELECT * FROM ($this->table) WHERE email = '$email'";
      $result = mysqli_query($this->db, $query);
      if (mysqli_num_rows($result) == 0) {
         return "User not found";
      }

      $user = mysqli_fetch_assoc($result);
      if (base64_decode($user['password'], false) == $password) {
         $_SESSION["id_user"] = $user["id_user"];
         $_SESSION["full_name"] = $user["full_name"];
         $_SESSION['email'] = $user['email'];
         $_SESSION['avatar'] = $user['avatar'];

         return $user = [
            "id_users" => $user["id_user"],
            "full_name" => $user["full_name"],
            'email' => $user['email'],
            'avatar' => $user['avatar'],
         ];

         return $user;
      } else {
         return "Wrong password";
      }
   }

   public  function updatePassword($id, $oldPassword, $newPassword)
   {
      $query = "SELECT * FROM $this->table WHERE id_users = $id";
      $result = mysqli_query($this->db, $query);
      if (mysqli_num_rows($result) == 0) {
         return "User not found";
      }

      $user = mysqli_fetch_assoc($result);
      if (base64_decode($user['password'], false) !== $oldPassword) {
         return "Wrong password";
      }

      $newPassword = base64_encode($newPassword);
      $query_update = "UPDATE $this->table SET password = '$newPassword' WHERE id_users = $id";
      $resultUpdate = mysqli_query($this->db, $query_update);
      if ($resultUpdate == false) {
         return "Failed to update password";
      }
      return [
         "full_name" => $user["full_name"],
         'email' => $user['email'],
         'id_users' => $user['id_users']
      ];
   }


   public function all_2($limit)
   {
      $query = "SELECT * FROM users LIMIT $limit";
      $result = mysqli_query($this->db, $query);
      return $this->convert_data($result);
   }

   public function top_user($limit)
   {
      $sql = "SELECT
    users.*,
    COUNT(posts.id_post) AS total_posts
FROM
    users
LEFT JOIN posts ON users.id_user = posts.user_id
GROUP BY
    users.id_user
ORDER BY
    total_posts
DESC LIMIT $limit";
      $result = $this->db->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
   }

   public function logout()
   {

      session_destroy();
      return 'Logout success';
   }

   public function total_user(){
      // mengambil jumlah postingan
      $query = "SELECT COUNT(users.id_user) AS total_user FROM users";
      $result = mysqli_query($this->db, $query);
      return $this->convert_data($result);
  }
}
