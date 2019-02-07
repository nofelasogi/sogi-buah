
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_buah extends CI_Model {

	public function ambilbuah(){
			$ambilbuah = $this->db->join('kategori', 'kategori.kode_kategori = buah.kode_kategori')->get('buah')->result();

			return $ambilbuah;
	}


	public function ambilkategori(){

			$ambilkategori = $this->db->get('kategori')->result();

			return $ambilkategori;
	}

	public function tambah($nama_file){

	if($nama_file == ""){

			$tambah = array(
				'buah' => $this->input->post('buah'),
				'tahun' => $this->input->post('tahun'),
				'kode_kategori' => $this->input->post('kategori'),
				'harga' => $this->input->post('harga'),
				// 'penerbit' => $this->input->post('penerbit'),
				// 'penulis' => $this->input->post('penulis'),
				'stok' => $this->input->post('stok'), );

	}else{

		$tambah = array(
				'buah' => $this->input->post('buah'),
				'tahun' => $this->input->post('tahun'),
				'kode_kategori' => $this->input->post('kategori'),
				'harga' => $this->input->post('harga'),
				'cover' => $nama_file,
				// 'penerbit' => $this->input->post('penerbit'),
				// 'penulis' => $this->input->post('penulis'),
				'stok' => $this->input->post('stok'), );

	}
	return $this->db->insert('buah', $tambah);
	}

public function tampil_ubah_buah($kode_buah){
		return $this->db->join('kategori', 'kategori.kode_kategori = buah.kode_kategori')->where('kode_buah',$kode_buah)->get('buah')->row();

	}



public function update(){
			$ubah = array(
				'buah' => $this->input->post('buah'),
				'tahun' => $this->input->post('tahun'),
				'kode_kategori' => $this->input->post('kategori'),
				'harga' => $this->input->post('harga'),
				// 'penerbit' => $this->input->post('penerbit'),
				// 'penulis' => $this->input->post('penulis'),
				'stok' => $this->input->post('stok'), );

			return $this->db->where('kode_buah',$this->input->post('kode_buah'))->update('buah', $ubah);

}


public function update_ft($nama_file){
				$ubah = array(
				'buah' => $this->input->post('buah'),
				'tahun' => $this->input->post('tahun'),
				'kode_kategori' => $this->input->post('kategori'),
				'harga' => $this->input->post('harga'),
				'cover' => $nama_file,
				// 'penerbit' => $this->input->post('penerbit'),
				// 'penulis' => $this->input->post('penulis'),
				'stok' => $this->input->post('stok'), );

		return $this->db->where('kode_buah',$this->input->post('kode_buah'))->update('buah', $ubah);





}


public function hapus($kode_buah ){
	return $this->db->where('kode_buah',$kode_buah)->delete('buah');
}




public function ambilbuahcart($kode_buah){
	return $this->db->where('kode_buah',$kode_buah )->get('buah')->row();

}

}

/* End of file M_buah.php */
/* Location: ./application/models/M_buah.php */

?>
