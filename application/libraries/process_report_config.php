<?php

class process_report_config {
    // ma variable
    public $operasional_tahunan_dan_rppt = array();
    public $operasional_tahunan_dan_rppt_rincian = array();
    public $investasi_rencana_korporasi_dan_rppt = array();
    public $laporan_anggaran_investasi_rencana_korporasi_rincian = array();
    public $kegiatan_rincian_anggaran_rppt_per_mata_anggaran = array();
    public $upload_data_siaga = array();
    
    // upload data siaga function
    public function upload_data_siaga(){
        $this->upload_data_siaga = array(
            "kode" => "B",
            "rekmanama" => "C",
            "nom_debet_anggaran" => "D",
            "nom_kredit_anggaran" => "E"
        );
    }
    
    // ma function
    public function operasional_tahunan_dan_rppt(){
        $this->operasional_tahunan_dan_rppt = array(
            "kode" => "B",
            "rekmakode" => "C",
            "rekmanama" => "D",
            "rekmakode" => "G",
            "rekmagroup" => "H",
            "lvl" => "I",
            "benchmarkang" => "J",
            "benchmarkprog" => "K",
            "benchmark_delta_nom" => "L",
            "benchmark_delta_perc" => "M",
            "anggaran" => "N",
            "anggaran_benchmarkang_nom" => "O",
            "anggaran_benchmarkang_perc" => "P",
            "anggaran_benchmarkprog_nom" => "Q",
            "anggaran_benchmarkprog_perc" => "R",
            "rppt1nom" => "S",
            "rppt1perc" => "T",
            "rppt2nom" => "U",
            "rppt2perc" => "V",
            "rppt3nom" => "W",
            "rppt3perc" => "X",
            "rppt4nom" => "Y",
            "rppt4perc" => "Z"
        );
    }
    
    public function operasional_tahunan_dan_rppt_rincian(){
        $this->operasional_tahunan_dan_rppt_rincian = array(
            "kode" => "B",
            "rekmakode" => "C",
            "rekmanama" => "D",
            "rekmagroup" => "J",
            "lvl" => "K",
            "benchmarkang" => "L",
            "benchmarkprog" => "M",
            "benchmark_delta_nom" => "N",
            "benchmark_delta_perc" => "O",
            "anggaran" => "P",
            "anggaran_benchmarkang_nom" => "Q",
            "anggaran_benchmarkang_perc" => "R",
            "anggaran_benchmarkprog_nom" => "S",
            "anggaran_benchmarkprog_perc" => "T",
            "rppt1nom" => "U",
            "rppt1perc" => "V",
            "rppt2nom" => "W",
            "rppt2perc" => "X",
            "rppt3nom" => "Y",
            "rppt3perc" => "Z",
            "rppt4nom" => "AA",
            "rppt4perc" => "AB"
        );
    }
    
    public function investasi_rencana_korporasi_dan_rppt(){
        $this->investasi_rencana_korporasi_dan_rppt = array(
            "kode" => "B",
            "rekmakode" => "C",
            "rekmanama" => "D",
            "rekmagroup" => "H",
            "benchmarkang" => "J",
            "benchmarkprog" => "K",
            "benchmark_delta_nom" => "L",
            "benchmark_delta_perc" => "M",
            "anggaran" => "N",
            "anggaran_benchmarkang_nom" => "O",
            "anggaran_benchmarkang_perc" => "P",
            "anggaran_benchmarkprog_nom" => "Q",
            "anggaran_benchmarkprog_perc" => "R",
            "rppt1nom" => "S",
            "rppt1perc" => "T",
            "rppt2nom" => "U",
            "rppt2perc" => "V",
            "rppt3nom" => "W",
            "rppt3perc" => "X",
            "rppt4nom" => "Y",
            "rppt4perc" => "Z",
            "lvl" => "I"
        );
    }
    
    public function laporan_anggaran_investasi_rencana_korporasi_rincian(){
        $this->laporan_anggaran_investasi_rencana_korporasi_rincian = array(
            "kode" => "B",
            "rekmakode" => "C",
            "rekmanama" => "D",
            "rekmagroup" => "J",
            "lvl" => "K",
            "benchmarkang" => "L",
            "benchmarkprog" => "M",
            "benchmark_delta_nom" => "N",
            "benchmark_delta_perc" => "O",
            "anggaran" => "P",
            "anggaran_benchmarkang_nom" => "Q",
            "anggaran_benchmarkang_perc" => "R",
            "anggaran_benchmarkprog_nom" => "S",
            "anggaran_benchmarkprog_perc" => "T",
            "rppt1nom" => "U",
            "rppt1perc" => "V",
            "rppt2nom" => "W",
            "rppt2perc" => "X",
            "rppt3nom" => "Y",
            "rppt3perc" => "Z",
            "rppt4nom" => "AA",
            "rppt4perc" => "AB"
        );
    }
    
    public function kegiatan_rincian_anggaran_rppt_per_mata_anggaran(){
        $this->kegiatan_rincian_anggaran_rppt_per_mata_anggaran = array(
            "kode" => "B",
            "rekmakode" => "C",
            "sbpkode" => "D",
            "pktkode" => "E",
            "group" => "F",
            "lvl" => "H",
            "keterangan" => "J",
            "rinkuantitas" => "N",
            "rinfrekwensi" => "O",
            "rintarif" => "P",
            "anggaran" => "Q",
            "rppt1nom" => "R",
            "rppt1perc" => "S",
            "rppt2nom" => "T",
            "rppt2perc" => "U",
            "rppt3nom" => "V",
            "rppt3perc" => "W",
            "rppt4nom" => "X",
            "rppt4perc" => "Y"
        );
    }
    
    // sbp variable
    public $program_strategis_ps = array();
    public $program_kerja_strategis_pks_non_strategis_pkns = array();
    public $program_kerja_tahunan_pkt_kegiatan_k = array();
    public $program_kerja_tahunan_pkt_rincian_kegiatan_rk = array();
    public $mata_anggaran_per_rincian_kegiatan = array();
    
    // sbp function
    function program_strategis_ps(){
        $this->program_strategis_ps = array(
            "kode" => "B",
            "sbpkode" => "C",
            "sbpnourut" => "D",
            "lvl" => "E",
            "satkerid" => "F",
            "pktkode" => "G",
            "pktnourut" => "H",
            "nama" => "I",
            "pktoutput" => "J",
            "sbpjenis" => "K",
            "nom_pendapatan" => "L",
            "nom_biaya" => "M",
            "nom_investasi" => "N",
            "nom_rencana_korporasi" => "O"
        );
    }
    
    function program_kerja_strategis_pks_non_strategis_pkns(){
        $this->program_kerja_strategis_pks_non_strategis_pkns = array(
            "kode" => "B",
            "sbpkode" => "C",
            "sbpnourut" => "D",
            "lvl" => "E",
            "satkerid" => "F",
            "pktkode" => "G",
            "pktnourut" => "H",
            "nama" => "I",
            "pktoutput" => "L",
            "sbpjenis" => "M",
            "nom_pendapatan" => "N",
            "nom_biaya" => "O",
            "nom_investasi" => "P",
            "nom_rencana_korporasi" => "Q"
        );
    }
    
    function program_kerja_tahunan_pkt_kegiatan_k(){
        $this->program_kerja_tahunan_pkt_kegiatan_k = array(
            "kode" => "B",
            "sbpkode" => "C",
            "pktkode" => "D",
            "sbpnourut" => "E",
            "lvl" => "F",
            "satkerid" => "G",
            "pktnourut" => "H",
            "nama" => "I",
            "pktoutput" => "N",
            "sbpjenis" => "O",
            "nom_pendapatan" => "P",
            "nom_biaya" => "Q",
            "nom_investasi" => "R",
            "nom_rencana_korporasi" => "S"
        );
    }
    
    function program_kerja_tahunan_pkt_rincian_kegiatan_rk(){
        $this->program_kerja_tahunan_pkt_rincian_kegiatan_rk = array(
            "kode" => "B",
            "sbpkode" => "C",
            "pktkode" => "D",
            "sbpnourut" => "E",
            "lvl" => "F",
            "satkerid" => "G",
            "pktnourut" => "H",
            "nama" => "I",
            "pktoutput" => "N",
            "sbpjenis" => "O",
            "nom_pendapatan" => "P",
            "nom_biaya" => "Q",
            "nom_investasi" => "R",
            "nom_rencana_korporasi" => "S"
        );
    }
    
    function mata_anggaran_per_rincian_kegiatan(){
        $this->mata_anggaran_per_rincian_kegiatan = array(
            "kode" => "B",
            "sbpkode" => "C",
            "pktkode" => "D",
            "rekmakode" => "E",
            "sbpnourut" => "F",
            "lvl" => "G",
            "satkerid" => "H",
            "pktnourut" => "I",
            "nama" => "J",
            "rekmanama" => "O",
            "pktoutput" => "P",
            "sbpjenis" => "Q",
            "anggaran" => "R",
            "rppt1nom" => "S",
            "rppt1perc" => "T",
            "rppt2nom" => "U",
            "rppt2perc" => "V",
            "rppt3nom" => "W",
            "rppt3perc" => "X",
            "rppt4nom" => "Y",
            "rppt4perc" => "Z"
        );
    }
}