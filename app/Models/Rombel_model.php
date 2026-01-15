<?php

namespace App\Models;
use CodeIgniter\Database\BaseBuilder;

use CodeIgniter\Model;

class Rombel_model extends Model
{
    protected $table = 't_rombel';

    public function getRombel($id)
    {
        return $this->db->table($this->table)
        ->join('r_tingkat_kelas','r_tingkat_kelas.id_tingkat_kelas = t_rombel.id_tingkat_kelas')
        ->where('id_tapel', $id)
        ->orderby('nm_rombel','ASC')
        ->get()->getResultArray();
    }
   
    public function saveRombel($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }
   
    public function editRombel($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_rombel', $id);
        return $builder->update($data);
    }
    public function hapusRombel($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_rombel' => $id]);
    }

}
