class Student extends Model {
    protected $table = 'students';

    public function find($id) {
        return $this->db->query("SELECT * FROM $this->table WHERE id = :id", ['id' => $id]);
    }
}
