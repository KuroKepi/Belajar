<?php

	Class M_asisten extends CI_Model
	{
		public function kode()
		{
			$this->db->select_max('Id_asisten', 'new');
			$query 	=	$this->db->get('asisten')->row_array();
			$kode 	=	$query['new'];
			$noUrut	=	(int) substr($kode, 3, 3);
			$noUrut++;
			$char 	=	"AS";
			$newID	=	$char. sprintf("%03s", $noUrut);
			return $newID;
		}

		public function add($id,$name,$status,$photo)
		{
			// $validasi 		= $this->db->get_where('barang', ['nama_barang' => $name])->num_rows();
			// if($validasi<=0)
			// {
				$data = array(
					'id_asisten'		=> $id,
					'nama_asisten'		=> $name,
					'status_asisten'	=> $status,
					'photo_asisten'		=> $photo
					);
					$this->db->insert('asisten',$data);
					// return TRUE;
			// }
			// else
			// {
			// 	return FALSE;
			// }
		}

		public function getAll()
		{
			$this->db->order_by('nama_asisten','ASC');
			return $this->db->get('asisten');
		}

		public function getbyId($id)
		{
			if($id != null)
			{
				$asisten 		= $this->db->get_where('asisten', ['Id_asisten' => $id]);
				return $asisten;
			}
		}

		public function delete($id)
		{
			$data	= array(
					'Id_asisten'	=> $id
			);
			$this->db->delete('asisten', $data);
		}

		public function edit($id,$name,$status,$photo)
		{
			$data	= array(
				'id_asisten'		=> $id,
				'nama_asisten'		=> $name,
				'status_asisten'	=> $status,
				'photo_asisten'		=> $photo
			);
			$this->db->where('id_asisten', $id);
			$this->db->update('asisten', $data);
		}
	}

?>
