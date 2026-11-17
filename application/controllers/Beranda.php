<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Beranda');
        $this->load->model('M_Pelanggan');
        $this->load->model('M_Olt');
        login();
    }
    public function index()
    {
        // Chart Data Cluster
        $hc_new = $this->M_Olt->hc_new()->result();
        $hc = [];
        $label = [];
        foreach ($hc_new as $row) {
            $label[] = $row->nama_cluster;
            $hc[] = (int)$row->hc;
        }
        $data['chart_data1'] = json_encode([
            'label' => $label,
            'hc' => $hc,
            'title' => 'KLIK SALAH SATU WARNA'
        ]);
        $data['hc'] = $hc;

        // Chart Data HP
        $hp_new = $this->M_Olt->hp_new()->result_array();
        $hp_label = [];
        $hp = [];
        $fat_aktif = [];
        $tur = [];
        foreach ($hp_new as $key => $value) {
            $hp_label[] = $value['nama_cluster'];
            $hp[] = (int)$value['hp'];
            $fat_aktif[] = $value['fat_aktif'];
            $tur[] = $hp[$key] ? number_format(($hc[$key] / $hp[$key]) * 100, 2) : '0.00';
        }
        $data['chart_data2'] = json_encode([
            'label' => $hp_label,
            'hp' => $hp,
            'fat_aktif' => $fat_aktif,
            'tur' => $tur,
            'title' => 'KLIK SALAH SATU WARNA'
        ]);

        // Chart Data Bulan
        $hc_bulan = $this->M_Olt->hc_bulan()->result();
        $bulan = [];
        $hc_bulan_arr = [];
        foreach ($hc_bulan as $row) {
            $bulan[] = $row->bulan;
            $hc_bulan_arr[] = (int)$row->hc;
        }
        $data['chart_data3'] = json_encode([
            'bulan' => $bulan,
            'hc' => $hc_bulan_arr,
            'title' => 'KLIK SALAH SATU WARNA'
        ]);

        // Chart Data OLT
        $hc_olt = $this->M_Olt->hc()->result();
        $olt_label = [];
        $hc_olt_arr = [];
        foreach ($hc_olt as $row) {
            $olt_label[] = $row->olt;
            $hc_olt_arr[] = (int)$row->hc;
        }
        $data['chart_data4'] = json_encode([
            'label' => $olt_label,
            'hc' => $hc_olt_arr,
            'title' => 'KLIK SALAH SATU WARNA'
        ]);
        $data['hc3'] = $hc_olt_arr;

        // Chart Data HP OLT
        $hp_olt = $this->M_Olt->hp()->result_array();
        $hp_olt_label = [];
        $hp_olt_arr = [];
        $fat_aktif_olt = [];
        $tur_olt = [];
        foreach ($hp_olt as $key => $value) {
            $hp_olt_label[] = $value['olt'];
            $hp_olt_arr[] = (int)$value['hp'];
            $fat_aktif_olt[] = $value['fat_aktif'];
            $tur_olt[] = $hp_olt_arr[$key] ? number_format(($hc_olt_arr[$key] / $hp_olt_arr[$key]) * 100, 2) : '0.00';
        }
        $data['chart_data5'] = json_encode([
            'label' => $hp_olt_label,
            'hp' => $hp_olt_arr,
            'fat_aktif' => $fat_aktif_olt,
            'tur' => $tur_olt,
            'title' => 'KLIK SALAH SATU WARNA'
        ]);

        // Data untuk info box dan tabel
        $data['title'] = 'Beranda';
        $data['title2'] = 'Dashboard';
        $data['title3'] = 'Pelanggan/Bulan';
        $data['mitra'] = $this->M_Beranda->mitra();
        $data['cluster'] = $this->M_Beranda->cluster();
        $data['pop'] = $this->M_Beranda->pop();
        $data['olt'] = $this->M_Beranda->olt();
        $data['odf'] = $this->M_Beranda->odf();
        $data['fdt'] = $this->M_Beranda->fdt();
        $data['fat'] = $this->M_Beranda->fat();
        $data['hp'] = $this->M_Beranda->hp()->result_array();
        $data['pelanggan'] = $this->M_Beranda->pelanggan();
        $data['potensi'] = $this->M_Beranda->potensi();

        // Tabel TUR Cluster
        $data['xnxx'] = $this->M_Olt->table1()->result_array();
        // Tabel TUR Kota
        $hc_wilayah = $this->M_Olt->tur_wilayah()->result();
        $hc1 = [];
        foreach ($hc_wilayah as $row) {
            $hc1[] = (int)$row->hc;
        }
        $data['hc1'] = $hc1;
        $data['xnxx1'] = $this->M_Olt->table2()->result_array();
        // Tabel TUR OLT
        $data['xnxx2'] = $this->M_Olt->table3()->result_array();

        $this->load->view('admin/template/header1', $data);
        $this->load->view('admin/beranda/index', $data);
        $this->load->view('admin/template/footer2', $data);
    }
    function get($nama_cluster)
    {
        $data['cluster'] = $this->M_Pelanggan->get($nama_cluster);
        $url = $data['cluster']['nama_cluster'];
        $url_slug = url_title($url, 'dash', TRUE);
        redirect(base_url('album/galeri/' . $url_slug));
    }
}
