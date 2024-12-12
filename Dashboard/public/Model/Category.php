<?php

require_once __DIR__ . "/model.php";


class Category extends Model
{

   protected $table = "categories";
   protected $primaryKey = "id_category";


   public function create($datas)
   {
      return parent::create_data($datas, $this->table);
   }

   public function all()
   {
      return parent::all_data($this->table);
   }

   public function all_category()
   {
      $query = "SELECT * FROM categories LIMIT 4";
      $result = mysqli_query($this->db, $query);

      return $this->convert_data($result);
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

   public function search($keyword, $start = null, $limit = null)
   {
      $queryLimit = '';
      if (isset($start) && isset($limit)) {
         $queryLimit = " LIMIT $start, $limit";
      }
      $keyword = " WHERE name_category LIKE '%{$keyword}%' $queryLimit";
      return parent::search_data($keyword, $this->table);
   }

   public function paginate($start, $limit)
   {
      return parent::paginate_data($this->table, $start, $limit);
   }

   public function total_cat(){
      // mengambil jumlah postingan
      $query = "SELECT COUNT(categories.id_category) AS total_cat FROM categories";
      $result = mysqli_query($this->db, $query);
      return $this->convert_data($result);
  }
}
