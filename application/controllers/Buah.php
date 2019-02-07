<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_buah','mbk');
	}

	public function index()
	{
		if($this->session->userdata('level')){

			$data['kategori']=$this->mbk->ambilkategori();
			$data['buah']=$this->mbk->ambilbuah();
			$data['konten']='v_buah';
			$this->load->view('template',$data);
		}else{
			redirect('Login','refresh');
		}
	}


	public function tambah(){
		$this->form_validation->set_rules('buah', 'buah', 'trim|required');
		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		// $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
		// $this->form_validation->set_rules('penulis', 'penulis', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');

		if ($this->form_validation->run() == TRUE) {

			$config['upload_path'] = './assets/gambar';
			$config['allowed_types'] = 'jpg|png';

			if($_FILES['cover']['name'] != ""){

				$this->load->library('upload', $config);


				if(!$this->upload->do_upload('cover')){

					$this->session->set_flashdata('pesan', $this->upload->display_errors());
					redirect('buah','refresh');

				}else{

					if($this->mbk->tambah($this->upload->data('file_name'))){

						$this->session->set_flashdata('pesan', 'anda berhasil menambah barang');
					}else{
						$this->session->set_flashdata('pesan', 'anda gagal menambah barang');
					}

					redirect('buah','refresh');


				}

			}else{

				if($this->mbk->tambah('')){
					$this->session->set_flashdata('pesan', 'anda berhasil menambah barang');
				}else{
					$this->session->set_flashdata('pesan', 'anda gagal menambah barang');
				}
				redirect('buah','refresh');
			}

		} else {
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('buah','refresh');
		}

	}

	public function tampil_ubah_buah($kode_buah){
		$data =  $this->mbk->tampil_ubah_buah($kode_buah);
		echo json_encode($data);

	}

	public function update(){

		if($this->input->post('update')){

			if($_FILES['cover']['name']==""){

				if($this->mbk->update()){

					$this->session->set_flashdata('pesan', 'sukses ubah data ');
				}else{

					$this->session->set_flashdata('pesan', 'gagal ubah data ');
				}
				redirect('buah','refresh');


			}else{


				$config['upload_path'] = './assets/gambar/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('cover')){

					$this->session->set_flashdata('pesan', $this->upload->display_errors());
					redirect('buah','refresh');

				}else{


					if($this->mbk->update_ft($this->upload->data('file_name'))){

						$this->session->set_flashdata('pesan', 'sukses ubah data ');

					}else{

						$this->session->set_flashdata('pesan', 'gagal ubah data ');

					}


					redirect('buah','refresh');


				}
			}

		}

	}

	public function hapus($kode_buah){
		if($this->mbk->hapus($kode_buah)){

			$this->session->set_flashdata('pesan', 'anda berhasil menghapus data buah');
			redirect('buah','refresh');

		}else{

			$this->session->set_flashdata('pesan', 'anda gagal menghapus data buah');
			redirect('buah','refresh');
		}
	}
}

/* End of file buah.php */
/* Location: ./application/controllers/buah.php */


?>
