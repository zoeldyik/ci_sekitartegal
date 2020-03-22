<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    public function index($start = 0)
    {
        // pagination config
        $config['base_url'] = base_url('home/index');
        $config['total_rows'] = $this->Home_model->jumlah_data();
        $config['per_page'] = 4;
        $config['uri_segment'] = 3;


        $config['full_tag_open'] = '<nav> <ul class="pagination pagination-sm justify-content-end">';
        $config['full_tag_close'] = '</ul> </nav>';


        $config['first_link'] = 'first';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');



        // init pagination
        $this->pagination->initialize($config);

        // dalam keadaan default $start adalah 0 tetapi setelah pagination di klik $start = $config['uri_segment']
        $data['datas'] = $this->Home_model->get_data(FALSE, $config['per_page'], $start);
        $data['kategori'] = $this->Home_model->get_kategori();


        // email form
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email belum diisi',
            'valid_email' => 'Email salah'
        ]);
        $this->form_validation->set_rules('pesan', 'Pesan', 'required', [
            'required' => 'Pesan kosong'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('home/index', $data);
            $this->load->view('templates/footer');
        } else {
            $kirimPesan = $this->email();

            if (!$kirimPesan) {
                var_dump('pesan gagal dikirim');
                die;
            }

            $this->session->set_flashdata('message', 'pesan telah terkirim');
            redirect(base_url());
        }
    }

    public function by_kategori($kategori_id)
    {

        $data['datas'] = $this->Home_model->get_data($kategori_id);
        $data['kategori'] = $this->Home_model->get_kategori();

        $this->load->view('templates/header');
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {

        $this->form_validation->set_rules('tempat', 'Tempat', "required|is_unique[data.tempat]", [
            "required" => "nama tempat tidak boleh kosong",
            "is_unique" => "nama tempat sudah ada"
        ]);
        $this->form_validation->set_rules('teks', 'Deskripsi', "required", [
            "required" => "deskripsi tidak boleh kosong"
        ]);
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = "Tambah Data";
            $data['kategori'] = $this->Home_model->get_kategori();
            $this->load->view('templates/header');
            $this->load->view('tambah/index', $data);
            $this->load->view('templates/footer');
        } else {
            $image = $this->upload_image();

            // jika image gagal di upload
            // atur flasdata dan redirect ke halaman Home/tambah
            if ($image === FALSE) {
                $this->session->set_flashdata('error', 'periksa kembali file fotomu');
                redirect('home/tambah');
            } else {
                $this->Home_model->insert_data($image);

                // resize image
                $this->create_thumb($image);

                redirect(base_url());
            }
        }
    }

    private function upload_image()
    {
        $config['upload_path']          = './image/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 1000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            //  jika gagal return false
            return FALSE;
        } else {
            // jika berhasil
            return $this->upload->data('file_name');
        }
    }



    private function create_thumb($nama_file)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = "./image/" . $nama_file;
        $config['new_image'] = "./image/thumbnail/thumb_" . $nama_file;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 400;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
    }



    public function hapus($id)
    {
        // jika session ada jalankan hapus
        if ($this->session->dahLogin) {
            $this->Home_model->hapus_data($id);
            redirect(base_url());
        } else {
            // jika tidak ada session redirect ke halaman home
            redirect(base_url());
        }
    }

    public function edit($id)
    {
        // jika session ada jalan function ini
        if ($this->session->dahLogin) {

            $this->form_validation->set_rules('tempat', 'Tempat', "required", [
                "required" => "nama tempat tidak boleh kosong"
            ]);
            $this->form_validation->set_rules('teks', 'Deskripsi', "required", [
                "required" => "deskripsi tidak boleh kosong"
            ]);


            // get data from database
            $data['data'] =  $this->Home_model->get_data_byId($id);
            $data['kategori'] = $this->Home_model->get_kategori();
            // nama foto lama
            $image_lama = $data['data']['foto'];



            if ($this->form_validation->run() === FALSE) {
                $data['title'] = "Edit Data";
                $this->load->view('templates/header');
                $this->load->view('home/edit', $data);
                $this->load->view('templates/footer');
            } else {

                // jika user tidak memilih foto baru
                if ($_FILES['foto']['name'] === '') {
                    $image = $image_lama;
                } else {
                    // jika user memilih foto baru
                    $image = $this->update_image();
                }

                // jika image gagal di upload
                // atur flasdata dan redirect ke halaman Home/tambah
                if ($image === FALSE) {
                    $this->session->set_flashdata('error', 'periksa kembali file fotomu');
                    redirect('home/edit');
                } else {
                    // jika user upload foto baru hapus foto lama di database
                    if ($image !== $image_lama) {
                        unlink("./image/$image_lama");
                        unlink("./image/thumbnail/thumb_" . $image_lama);
                    }

                    $this->Home_model->update_data($image);

                    // buat thumbnail
                    $this->create_thumb($image);

                    redirect('home');
                }
            }
        } else {
            // jika tidak ada session redirect ke halaman home
            redirect("home");
        }
    }

    public function update_image()
    {
        $config['upload_path']          = './image/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 1000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            //  jika gagal return false
            return FALSE;
        } else {
            return $this->upload->data('file_name');
        }
    }


    public function kategori()
    {
        // jika session ada jalankan function
        if ($this->session->dahLogin) {
            $data['title'] = "Daftar Kategori";
            $data['kategori'] = $this->Home_model->get_kategori();
            $this->load->view('templates/header');
            $this->load->view('kategori/index', $data);
            $this->load->view('templates/footer');
        } else {
            // jika tidak ada session redirect ke halaman home
            redirect("home");
        }
    }




    public function hapus_kategori($id)
    {
        // jika session ada jalankan function
        if ($this->session->dahLogin) {
            $this->Home_model->hapus_kategori($id);
            redirect('home/kategori');
        } else {
            // jika tidak ada session redirect ke halaman home
            redirect("home");
        }
    }




    public function tambah_kategori()
    {
        // jika session ada jalankan function
        if ($this->session->dahLogin) {

            $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[kategori.nama]', [
                'required' => 'kamu belum memasukkan nama kategori',
                'is_unique' => 'kategori tersebut sudah ada'
            ]);

            if ($this->form_validation->run() === FALSE) {
                $data['title'] = "Tambah Kategori";
                $this->load->view('templates/header');
                $this->load->view('kategori/tambah_kategori', $data);
                $this->load->view('templates/footer');
            } else {
                $this->Home_model->add_kategori();
                redirect('kategori');
            }
        } else {
            // jika tidak ada session redirect ke halaman home
            redirect("home");
        }
    }


    private function email()
    {
        $this->load->library('email');

        $pengirim = $this->input->post('email');
        $pesan = $this->input->post('pesan');
        $subject = "pesan dari web Seputar Tegal";

        $this->email->from($pengirim);
        $this->email->to('zoeldyik@gmail.com');

        $this->email->subject($subject);
        $this->email->message($pesan);

        return $this->email->send();
    }
}