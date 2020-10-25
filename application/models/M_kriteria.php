<?php

	Class M_kriteria extends CI_Model
	{
		public function kode()
		{
			$this->db->select_max('id_kriteria', 'new');
			$query 	=	$this->db->get('kriteria')->row_array();
			$kode 	=	$query['new'];
			$noUrut	=	(int) substr($kode, 3, 3);
			$noUrut++;
			$char 	=	"KR";
			$newID	=	$char. sprintf("%03s", $noUrut);
			return $newID;
		}

		public function getAll()
		{
			$this->db->order_by('nama_kriteria','ASC');
			return $this->db->get('kriteria');
		}

		public function getbyId($id)
		{
			if($id != null)
			{
				$kriteria 		= $this->db->get_where('kriteria', ['Id_kriteria' => $id]);
				return $kriteria;
			}
		}

		public function add($id,$name,$status,$bobot)
		{
				$data = array(
				'Id_kriteria'		=> $id,
				'nama_kriteria'		=> $name,
				'status_kriteria'	=> $status,
				'bobot_kriteria'	=> $bobot
				);
				$this->db->insert('kriteria',$data);
		}

		public function delete($id)
		{
			$data = array(
				'Id_kriteria'		=> $id
			);
			$this->db->delete('kriteria',$data);
		}

		public function edit($id,$name,$status,$bobot)
		{
			$data	= array(
				'Id_kriteria'		=> $id,
				'nama_kriteria'		=> $name,
				'status_kriteria'	=> $status,
				'bobot_kriteria'	=> $bobot
			);
			$this->db->where('Id_kriteria', $id);
			$this->db->update('kriteria', $data);
		}
	}
?>
