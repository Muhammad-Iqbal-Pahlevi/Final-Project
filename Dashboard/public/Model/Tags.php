<?php

require_once __DIR__ . "/Model.php";


class Tags extends Model{

    protected $table = "tags";
    protected $primaryKey = "id_tag";


       public function create($datas){
          return parent::create_data($datas, $this->table);
       }

       public function all(){
          return parent::all_data($this->table);
       } 


       public function find($id){
          return parent::find_data($id, $this->primaryKey, $this->table);
       }

       public function update($id, $datas){
          return parent::update_data($id, $this->primaryKey, $datas, $this->table);
       }

       public function delete($id){
          return parent::delete_data($id, $this->primaryKey, $this->table);
       }

       public function search($keyword, $start = null, $limit = null)
    {
      $queryLimit = '';
      if(isset($start) && isset($limit)){
         $queryLimit = " LIMIT $start, $limit";
      }
      $keyword = " WHERE name_category LIKE '%{$keyword}%' $queryLimit";
      return parent::search_data($keyword, $this->table);
    }

       public function paginate($start, $limit){
        return parent::paginate_data($this->table, $start, $limit);
       }    
}