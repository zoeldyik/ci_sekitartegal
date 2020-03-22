<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($kategori_id = FALSE, $limit = FALSE, $start = FALSE)
    {

        if ($kategori_id === FALSE) {
            if ($limit) {
                $this->db->limit($limit, $start);
            }
            $this->db->order_by('id', "DESC");
            return $this->db->get('data')->result_array();
        }

        $this->db->order_by('id', "DESC");
        $this->db->where('kategori_id', $kategori_id);
        return $this->db->get('data')->result_array();
    }



    public function get_data_byId($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('data')->row_array();
    }


    public function jumlah_data()
    {
        return $this->db->count_all('data');
    }


    public function get_kategori()
    {
        $this->db->order_by('id', "DESC");
        return $this->db->get('kategori')->result_array();
    }




    public function insert_data($image)
    {
        $data = [
            "kategori_id" => $this->input->post('kategori', TRUE),
            "foto" => $image,
            "tempat" => htmlspecialchars($this->input->post('tempat', TRUE)),
            "teks" => htmlspecialchars($this->input->post('teks', TRUE)),
            "website" => htmlspecialchars($this->input->post('website', TRUE)),
            "instagram" => htmlspecialchars($this->input->post('instagram', TRUE))
        ];

        $this->db->insert('data', $data);
    }




    public function hapus_data($id)
    {
        $this->db->where('id', $id);
        $namaFoto = $this->db->get('data')->row_array();
        $namaFoto = $namaFoto['foto'];

        // hapus foto pada database
        unlink("./image/$namaFoto");
        unlink("./image/thumbnail/thumb_" . $namaFoto);

        // hapus data pada tabel
        $this->db->delete('data', ['id' => $id]);
    }




    public function update_data($image)
    {
        $id =  $this->input->post('id');

        $data = [
            "kategori_id" => $this->input->post('kategori', TRUE),
            "foto" => $image,
            "tempat" => htmlspecialchars($this->input->post('tempat', TRUE)),
            "teks" => htmlspecialchars($this->input->post('teks', TRUE)),
            "website" => htmlspecialchars($this->input->post('website', TRUE)),
            "instagram" => htmlspecialchars($this->input->post('instagram', TRUE))
        ];

        $this->db->where('id', $id);
        $this->db->update('data', $data);
    }


    public function add_kategori()
    {
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', TRUE))
        ];

        $this->db->insert('kategori', $data);
    }

    public function hapus_kategori($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kategori');
    }
}