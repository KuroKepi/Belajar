<?php

	Class M_penilaian extends CI_Model
	{
		public function kode()
		{
			$this->db->select_max('Id_nilai', 'new');
			$query 	=	$this->db->get('nilai')->row_array();
			$kode 	=	$query['new'];
			$noUrut	=	(int) substr($kode, 3, 3);
			// $noUrut++;
			$char 	=	"NL";
			$newID	=	$char. sprintf("%03s", $noUrut);
			return $newID;
		}

		public function getbyYear($tahun)
		{
			$this->db->select('nilai.*, asisten.*');
			$this->db->from('nilai');
			$this->db->join('asisten', 'asisten.Id_asisten = nilai.Id_asisten');
			$this->db->group_by('asisten.Id_asisten');
			$this->db->order_by('asisten.nama_asisten','ASC');
			if($tahun != null)
			{
				$this->db->where('tahun_nilai',$tahun);
			}
			$nilai = $this->db->get();
			return $nilai;
		}

		public function add($id,$id_brg,$id_kriteria,$nilai,$tahunn)
		{
			for($i=0;$i<count($id_kriteria);$i++)
			{
				$data	= array(
					'Id_nilai'		=> $id[$i],
					'Id_asisten'		=> $id_brg,
					'Id_kriteria'	=> $id_kriteria[$i],
					'nilai_asisten'	=> $nilai[$i],
					'tahun_nilai'	=>$tahunn
				);

				$simpan	= $this->db->insert('nilai',$data);
			}
			return $simpan;
		}

		public function delete($id,$tahun)
		{
			$this->db->where('Id_asisten',$id);
			$this->db->where('tahun_nilai',$tahun);
			$this->db->delete('nilai');
		}

		public function getAll($id,$thn)
		{
			$this->db->select('nilai.*, asisten.*, kriteria.*');
			$this->db->from('nilai');
			$this->db->join('asisten', 'asisten.Id_asisten = nilai.Id_asisten');
			$this->db->join('kriteria', 'kriteria.Id_kriteria = nilai.Id_kriteria');
			$this->db->order_by('kriteria.nama_kriteria','ASC');
			if($id != null && $thn !=null)
			{
				$this->db->where('nilai.Id_asisten',$id);
				$this->db->where('tahun_nilai',$thn);
			}
			$hasil	=	$this->db->get();
			return $hasil;
		}
	}

?>
