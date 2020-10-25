<?php

	Class M_perhitungan extends CI_Model
	{
		
		public function getbyyear($tahun)
		{
			$this->db->select('nilai.*');
			$this->db->from('nilai');
			if($tahun != null)
			{
				$this->db->where('tahun_nilai',$tahun);
			}
			$nilai = $this->db->get();
			return $nilai;
		}	
		public function normalisasi($tahun)
		{
			//normalisasi bobot
			$this->db->select(' kriteria.*');
			$this->db->from('kriteria');
			$this->db->order_by('nama_kriteria','ASC');
			$krit = $this->db->get();
			// return $krit;
			$total_krit	=	$krit->result();

			$W=array();
			$attribute=array();
			foreach($total_krit as $row ) :
			{
				$W[$row->Id_kriteria]=$row->bobot_kriteria;
				$attribute[$row->Id_kriteria]=$row->status_kriteria;
			}
			endforeach;

			$krit->free_result();
			$sigma_w=array_sum($W);
			foreach($W as $j=>$w)
			{
					$this->db->select('nilai.*, kriteria.*');
					$this->db->from('nilai');
					$this->db->join('kriteria','kriteria.Id_kriteria = nilai.Id_kriteria');
					$this->db->where('kriteria.Id_kriteria',$j);
					$kriteria= $this->db->get()->row();
				$nil_normalisasi[] = array(
					'kriteria'			=> $j,
					'bobot_hasil'		=> $w/$sigma_w,
					'nama_k'			=> $kriteria->nama_kriteria
				);
			  $W[$j]=$w/$sigma_w;
			}
			return $nil_normalisasi;
			//end
		}
		public function vektorS($tahun)
		{
				//normalisasi bobot
				$this->db->select(' kriteria.*');
				$this->db->from('kriteria');
				$this->db->order_by('nama_kriteria','ASC');
				$krit = $this->db->get();
				// return $krit;
				$total_krit	=	$krit->result();
	
				$W=array();
				$attribute=array();
				foreach($total_krit as $row ) :
				{
					$W[$row->Id_kriteria]=$row->bobot_kriteria;
					$attribute[$row->Id_kriteria]=$row->status_kriteria;
				}
				endforeach;
	
				$krit->free_result();
				$sigma_w=array_sum($W);
				foreach($W as $j=>$w)
				{
				  $W[$j]=$w/$sigma_w;
				}
				//end
				//perhitungan vektor S
				$this->db->select('nilai.*');
				$this->db->from('nilai');
				$this->db->join('asisten', 'asisten.Id_asisten = nilai.Id_asisten');
				$this->db->join('kriteria','kriteria.Id_kriteria = nilai.Id_kriteria');
				$this->db->order_by('asisten.nama_asisten','ASC');
				if($tahun != null)
				{
					$this->db->where('tahun_nilai',$tahun);
				}
				$alternatif = $this->db->get();
				$total_alternatif = $alternatif->result();
	
				$X=array();
				$alternative='';
				
				foreach($total_alternatif as $row) :
				{
					if($row->Id_asisten!=$alternative)
					  {
						$X[$row->Id_asisten]=array();
						$alternative=$row->Id_asisten;
					  }
					  $X[$row->Id_asisten][$row->Id_kriteria]=$row->nilai_asisten;
				}
				endforeach;
	
				$S=array();
				foreach($X as $alternative => $x)
				{
					$S[$alternative]=1;
					foreach($x as $criteria => $nilai)
					{
						$this->db->select('nilai.*, asisten.*');
						$this->db->from('nilai');
						$this->db->join('asisten', 'asisten.Id_asisten = nilai.Id_asisten');
						$this->db->join('kriteria','kriteria.Id_kriteria = nilai.Id_kriteria');
						$this->db->where('asisten.Id_asisten',$alternative);
						$nama= $this->db->get()->row();
						$S[$alternative]*=pow($nilai,($attribute[$criteria]=='2'?-$W[$criteria]:$W[$criteria]));
					};
					$nilai_S[] = array(
						'id_s' 		=> $alternative,
						'S'			=> $S[$alternative],
						'nama_s'	=> $nama->nama_asisten
					);
				}
				return $nilai_S;
				//end
		}
		public function vektorV($tahun)
		{
			//normalisasi bobot
			$this->db->select(' kriteria.*');
			$this->db->from('kriteria');
			$this->db->order_by('nama_kriteria','ASC');
			$krit = $this->db->get();
			// return $krit;
			$total_krit	=	$krit->result();

			$W=array();
			$attribute=array();
			foreach($total_krit as $row ) :
			{
				$W[$row->Id_kriteria]=$row->bobot_kriteria;
                $attribute[$row->Id_kriteria]=$row->status_kriteria;
			}
			endforeach;

			$krit->free_result();
			$sigma_w=array_sum($W);
			foreach($W as $j=>$w)
			{
			  $W[$j]=$w/$sigma_w;
			}
			//end
			//perhitungan vektor S
			$this->db->select('nilai.*');
			$this->db->from('nilai');
			$this->db->join('asisten', 'asisten.Id_asisten = nilai.Id_asisten');
			$this->db->join('kriteria','kriteria.Id_kriteria = nilai.Id_kriteria');
			$this->db->order_by('asisten.nama_asisten','ASC');
			if($tahun != null)
			{
				$this->db->where('tahun_nilai',$tahun);
			}
			$alternatif = $this->db->get();
			$total_alternatif = $alternatif->result();

			$X=array();
			$alternative='';
			
			foreach($total_alternatif as $row) :
			{
				if($row->Id_asisten!=$alternative)
                  {
                    $X[$row->Id_asisten]=array();
                    $alternative=$row->Id_asisten;
                  }
                  $X[$row->Id_asisten][$row->Id_kriteria]=$row->nilai_asisten;
			}
			endforeach;

			$S=array();
			foreach($X as $alternative => $x)
			{
				$S[$alternative]=1;
				foreach($x as $criteria => $nilai)
				{
					$S[$alternative]*=pow($nilai,($attribute[$criteria]=='2'?-$W[$criteria]:$W[$criteria]));
				};
			}
			//end
			//perhitungan vektor V
			$V=array();
            $sigma_s=array_sum($S);
			foreach($S as $alternative=>$s)
                 {
					$this->db->select('nilai.*, asisten.*');
					$this->db->from('nilai');
					$this->db->join('asisten', 'asisten.Id_asisten = nilai.Id_asisten');
					$this->db->join('kriteria','kriteria.Id_kriteria = nilai.Id_kriteria');
					$this->db->where('asisten.Id_asisten',$alternative);
					$nama= $this->db->get()->row();
					 $nilai_V[] = array(
						 'id_v' 	=> $alternative,
						 'V'  		=> $V[$alternative]=$s/$sigma_s,
						 'nama_v'	=> $nama->nama_asisten
					 );
                	$V[$alternative]=$s/$sigma_s;
				 }
			return $nilai_V;
			echo "<pre>";
			//    print_r($W);
			//    print_r($attribute);
			//    print_r($sigma_w);
			    // print_r($nil_normalisasi);
			//    print_r($total_alternatif);
			//    print_r($X);
			//    print_r($nilai_V);
			//    print_r($x);
			//    print_r($nilai);
			//    print_r($criteria);
			//    print_r($nilai_S);
			//    print_r($nilai_V);
			//    print_r($V[$alternative]);
       		echo "</pre>";
			die();
		}

		public function perangkingan($tahun)
		{
			//normalisasi bobot
			$this->db->select(' kriteria.*');
			$this->db->from('kriteria');
			$this->db->order_by('nama_kriteria','ASC');
			$krit = $this->db->get();
			// return $krit;
			$total_krit	=	$krit->result();

			$W=array();
			$attribute=array();
			foreach($total_krit as $row ) :
			{
				$W[$row->Id_kriteria]=$row->bobot_kriteria;
                $attribute[$row->Id_kriteria]=$row->status_kriteria;
			}
			endforeach;

			$krit->free_result();
			$sigma_w=array_sum($W);
			foreach($W as $j=>$w)
			{
			  $W[$j]=$w/$sigma_w;
			}
			//end
			//perhitungan vektor S
			$this->db->select('nilai.*');
			$this->db->from('nilai');
			$this->db->join('asisten', 'asisten.Id_asisten = nilai.Id_asisten');
			$this->db->join('kriteria','kriteria.Id_kriteria = nilai.Id_kriteria');
			$this->db->order_by('asisten.nama_asisten','ASC');
			if($tahun != null)
			{
				$this->db->where('tahun_nilai',$tahun);
			}
			$alternatif = $this->db->get();
			$total_alternatif = $alternatif->result();

			$X=array();
			$alternative='';
			
			foreach($total_alternatif as $row) :
			{
				if($row->Id_asisten!=$alternative)
                  {
                    $X[$row->Id_asisten]=array();
                    $alternative=$row->Id_asisten;
                  }
                  $X[$row->Id_asisten][$row->Id_kriteria]=$row->nilai_asisten;
			}
			endforeach;

			$S=array();
			foreach($X as $alternative => $x)
			{
				$S[$alternative]=1;
				foreach($x as $criteria => $nilai)
				{
					$S[$alternative]*=pow($nilai,($attribute[$criteria]=='2'?-$W[$criteria]:$W[$criteria]));
				};
			}
			//end
			//perhitungan vektor V
			$V=array();
            $sigma_s=array_sum($S);
			foreach($S as $alternative=>$s)
                 {
                	$V[$alternative]=$s/$sigma_s;
				 }
			//end
			//perangkingan
			arsort($V);
			foreach($V as $alternative=>$result)
			{
				$this->db->select('nilai.*, asisten.*');
				$this->db->from('nilai');
				$this->db->join('asisten', 'asisten.Id_asisten = nilai.Id_asisten');
				$this->db->join('kriteria','kriteria.Id_kriteria = nilai.Id_kriteria');
				$this->db->where('asisten.Id_asisten',$alternative);
				$nama= $this->db->get()->row();
				$hasil_akhir[]= array(
					'id_hasil' => $alternative,
					'hasil'	   => $result,
					'nama'		=>$nama->nama_asisten
				);
			}
			return $hasil_akhir;
			// echo "<pre>";
			//    print_r($W);
			//    print_r($attribute);
			//    print_r($sigma_w);
			    // print_r($nil_normalisasi);
			//    print_r($total_alternatif);
			//    print_r($X);
			//    print_r($nilai_V);
			//    print_r($x);
			//    print_r($nilai);
			//    print_r($criteria);
			//    print_r($nilai_S);
			//    print_r($nilai_V);
			//    print_r($V[$alternative]);
			// 	  print_r($hasil_akhir);
       		// echo "</pre>";
			// die();
		}
	}
?>
