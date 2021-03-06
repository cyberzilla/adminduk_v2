<?php
//require_once '../lib/PHPRtfLite.php';
//require_once '../config.php';

// registers PHPRtfLite autoloader (spl)
PHPRtfLite::registerAutoloader();
// rtf document instance
$rtf = new PHPRtfLite();


//paper size LEGAL
// default unit is cm
$rtf->setPaperWidth(21.6);  // in cm
$rtf->setPaperHeight(33);   // in cm

//set margins
$rtf->setMarginLeft(2);
$rtf->setMarginRight(2);
$rtf->setMarginTop(1.3);
$rtf->setMarginBottom(1.5);
//paragraf format
$pf = new PHPRtfLite_ParFormat();
$pf->setSpaceAfter(0);
$pf->setSpaceBefore(0);
//set fonts
$section = $rtf->addSection();
$fontdef = new PHPRtfLite_Font(10, 'Arial', '#000');
$fontsml = new PHPRtfLite_Font(9, 'Arial', '#000');
$fontkds = new PHPRtfLite_Font(14, 'Arial', '#000');
//kop surat
$kop=$section->addTable();
$kop->addColumnsList(array(4.2,0.2,5.0,0.7,0.2,6));
$kop->addRow(0.8);
$kop->writeToCell(1,6,'<b>Kode. F-2.01</b>',$fontkds);
$kode=$kop->getCell(1,6);
$kode->setTextAlignment('right');
$kop->addRows(4,0.4);
$kop->writeToCell(2,1,'Pemerintah Desa/Kelurahan');
$kop->writeToCell(2,2,':');
$kop->writeToCell(2,3,ufirst(desa));
$kop->writeToCell(2,4,'Ket');
$kop->writeToCell(2,5,':');
$kop->writeToCell(2,6,'Lembar 1 Untuk Yang Bersangkutan');

$kop->writeToCell(3,1,'Kecamatan');
$kop->writeToCell(3,2,':');
$kop->writeToCell(3,3,ufirst(kecamatan));
$kop->writeToCell(3,4,'');
$kop->writeToCell(3,5,'');
$kop->writeToCell(3,6,'Lembar 2 Untuk UPTD/Instansi Pelaksana');

$kop->writeToCell(4,1,'Kabupaten / Kota');
$kop->writeToCell(4,2,':');
$kop->writeToCell(4,3,ufirst(kabupaten));
$kop->writeToCell(4,4,'');
$kop->writeToCell(4,5,'');
$kop->writeToCell(4,6,'Lembar 3 Untuk Desa/Kelurahan');

$kop->writeToCell(5,1,'Kode Wilayah');
$kop->writeToCell(5,2,':');
$kop->writeToCell(5,3,dewil);
$kop->writeToCell(5,4,'');
$kop->writeToCell(5,5,'');
$kop->writeToCell(5,6,'Lembar 4 Untuk Kecamatan');
//kop font
$kop->setFontForCellRange($fontsml, 2, 1, 5, 6);

//judul surat
$kop =  new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_CENTER);
$section->writeText("<u>SURAT KETERANGAN KELAHIRAN</u>",$fontdef,$kop);
$section->writeText("Nomor: ".$data[0]."/".$data[1]."/".$lconf['ns']."<br />",$fontdef,$kop);

//info nama dan nomor kk
$umum = $section->addTable();
$umum->addColumnsList(array(4.2,0.5,12.3));
$umum->addRows(2,0.4);
$umum->writeToCell(1,1,'Nama Kepala Keluarga');
$umum->writeToCell(1,2,':');
$umum->writeToCell(1,3,$namakk);

$umum->writeToCell(2,1,'Nomor Kepala Keluarga');
$umum->writeToCell(2,2,':');
$umum->writeToCell(2,3,$data[3]);

// border tabel
$grsats = new PHPRtfLite_Border(
    $rtf,                                       // PHPRtfLite instance
    new PHPRtfLite_Border_Format(0, '#00FF00'), // left border: 2pt, green color
    new PHPRtfLite_Border_Format(1, '#000000'), // top border: 1pt, yellow color
    new PHPRtfLite_Border_Format(0, '#FF0000'), // right border: 2pt, red color
    new PHPRtfLite_Border_Format(0, '#0000FF')  // bottom border: 1pt, blue color
);
$grsbwg = new PHPRtfLite_Border(
    $rtf,                                       // PHPRtfLite instance
    new PHPRtfLite_Border_Format(0, '#00FF00'), // left border: 2pt, green color
    new PHPRtfLite_Border_Format(1, '#000000'), // top border: 1pt, yellow color
    new PHPRtfLite_Border_Format(0, '#FF0000'), // right border: 2pt, red color
    new PHPRtfLite_Border_Format(1, '#000000')  // bottom border: 1pt, blue color
);

//DATA JENAZAH
$section->writeText('<b>BAYI / ANAK</b>',$fontdef);
$baby=$section->addTable();
$baby->addColumnsList(array(4.2,0.5,12.3));
$baby->addRows(11,0.4);
//nik
$baby->writeToCell(1,1,' 1. NAMA');
$baby->writeToCell(1,2,':');
$baby->writeToCell(1,3,strtoupper($data[4]));
//nama
$baby->writeToCell(2,1,' 2. Jenis Kelamin');
$baby->writeToCell(2,2,':');
$baby->writeToCell(2,3,$data[5]);
//kelamin
$baby->writeToCell(3,1,' 3. Tempat Dilahirkan');
$baby->writeToCell(3,2,':');
$baby->writeToCell(3,3,$data[6]);
//tg lahir
$baby->writeToCell(4,1,' 4. Tempat Kelahiran');
$baby->writeToCell(4,2,':');
$baby->writeToCell(4,3,$data[7]);
//tp lahir
$baby->writeToCell(5,1,' 5. Hari dan Tanggal Lahir');
$baby->writeToCell(5,2,':');
$baby->writeToCell(5,3,$hariLahir);
//agama
$baby->writeToCell(6,1,' 6. Pukul');
$baby->writeToCell(6,2,':');
$baby->writeToCell(6,3,$data[0]);
//pekerjaan
$baby->writeToCell(7,1,' 7. Jenis Kelahiran');
$baby->writeToCell(7,2,':');
$baby->writeToCell(7,3,$data[10]);
//alamat
$baby->writeToCell(8,1,' 8. Kelahiran Ke');
$baby->writeToCell(8,2,':');
$baby->writeToCell(8,3,$data[11]);
//anak-ke
$baby->writeToCell(9,1,' 9. Penolong Kelahiran');
$baby->writeToCell(9,2,':');
$baby->writeToCell(9,3,$data[12]);
//tgl mati
$baby->writeToCell(10,1,'10. Berat Bayi');
$baby->writeToCell(10,2,':');
$baby->writeToCell(10,3,$data[13]." Kg");
//pukul
$baby->writeToCell(11,1,'11. Panjang Bayi');
$baby->writeToCell(11,2,':');
$baby->writeToCell(11,3,$data[14]." cm");


$baby->setBorderForCellRange($grsats, 1, 1, 11, 3);
$baby->setBorderForCellRange($grsbwg, 11, 1, 11, 3);


///nyokap
$section->writeText('<b>IBU</b>',$fontdef);
$nyokap=$section->addTable();
$nyokap->addColumnsList(array(4.2,0.5,12.3));
$nyokap->addRows(8,0.4);
// nik
$nyokap->writeToCell(1,1,' 1. NIK');
$nyokap->writeToCell(1,2,':');
$nyokap->writeToCell(1,3,$data[15]);
// nama lengkap
$nyokap->writeToCell(2,1,' 2. Nama Lengkap');
$nyokap->writeToCell(2,2,':');
$nyokap->writeToCell(2,3,$ibu['nama_lengkap']);
// tanggal lahir
$nyokap->writeToCell(3,1,' 3. Tanggal Lahir');
$nyokap->writeToCell(3,2,':');
$nyokap->writeToCell(3,3,balikTanggal($ibu['tg_lahir']));
// pekerjaan
$nyokap->writeToCell(4,1,' 4. Pekerjaan');
$nyokap->writeToCell(4,2,':');
$nyokap->writeToCell(4,3,$ibu['pekerjaan']);
// alamat
$nyokap->writeToCell(5,1,' 5. Alamat');
$nyokap->writeToCell(5,2,':');
$nyokap->writeToCell(5,3,ufirst(desa)." RT. ".$ibu['rt']." RW. ".$ibu['rw']);
// kewarganegaraan
$nyokap->writeToCell(6,1,' 6. Kewarganegaraan');
$nyokap->writeToCell(6,2,':');
$nyokap->writeToCell(6,3,$ibu['kewarganegaraan']);
// kebangsaan
$nyokap->writeToCell(7,1,' 7. Kebangsaan');
$nyokap->writeToCell(7,2,':');
$nyokap->writeToCell(7,3,$ibu['kewarganegaraan']);
//tgl nikah
$nyokap->writeToCell(8,1,' 8. Tgl. Pencatatan Perkawinan');
$nyokap->writeToCell(8,2,':');
$nyokap->writeToCell(8,3,balikTanggal($data[16]));

$nyokap->setBorderForCellRange($grsats, 1, 1, 8, 3);
$nyokap->setBorderForCellRange($grsbwg, 8, 1, 8, 3);

///bokap
$section->writeText('<b>AYAH</b>',$fontdef);
$bhokap=$section->addTable();
$bhokap->addColumnsList(array(4.2,0.5,12.3));
$bhokap->addRows(7,0.4);
// nik
$bhokap->writeToCell(1,1,' 1. NIK');
$bhokap->writeToCell(1,2,':');
$bhokap->writeToCell(1,3,$data[17]);
// nama lengkap
$bhokap->writeToCell(2,1,' 2. Nama Lengkap');
$bhokap->writeToCell(2,2,':');
$bhokap->writeToCell(2,3,$bpk['nama_lengkap']);
// tanggal lahir
$bhokap->writeToCell(3,1,' 3. Tanggal Lahir');
$bhokap->writeToCell(3,2,':');
$bhokap->writeToCell(3,3,balikTanggal($bpk['tg_lahir']));
// pekerjaan
$bhokap->writeToCell(4,1,' 4. Pekerjaan');
$bhokap->writeToCell(4,2,':');
$bhokap->writeToCell(4,3,$bpk['pekerjaan']);
// alamat
$bhokap->writeToCell(5,1,' 5. Alamat');
$bhokap->writeToCell(5,2,':');
$bhokap->writeToCell(5,3,ufirst($bpk['dusun'])." RT RW ");
// kewarganegaraan
$bhokap->writeToCell(6,1,' 6. Kewarganegaraan');
$bhokap->writeToCell(6,2,':');
$bhokap->writeToCell(6,3,$bpk['kewarganegaraan']);
// kebangsaan
$bhokap->writeToCell(7,1,' 7. Kebangsaan');
$bhokap->writeToCell(7,2,':');
$bhokap->writeToCell(7,3,$bpk['kewarganegaraan']);

$bhokap->setBorderForCellRange($grsats, 1, 1, 5, 3);
$bhokap->setBorderForCellRange($grsbwg, 5, 1, 5, 3);

/// pelapor
$section->writeText('<b>PELAPOR</b>',$fontdef);
$lapor=$section->addTable();
$lapor->addColumnsList(array(4.2,0.5,12.3));
$lapor->addRows(5,0.4);
// nik
$lapor->writeToCell(1,1,' 1. NIK');
$lapor->writeToCell(1,2,':');
$lapor->writeToCell(1,3,$data[18]);
// nama lengkap
$lapor->writeToCell(2,1,' 2. Nama Lengkap');
$lapor->writeToCell(2,2,':');
$lapor->writeToCell(2,3,$lpr['nama_lengkap']);
// tanggal lahir
$lapor->writeToCell(3,1,' 3. Tanggal Lahir');
$lapor->writeToCell(3,2,':');
$lapor->writeToCell(3,3,balikTanggal($lpr['tg_lahir']));
// pekerjaan
$lapor->writeToCell(4,1,' 4. Pekerjaan');
$lapor->writeToCell(4,2,':');
$lapor->writeToCell(4,3,$lpr['pekerjaan']);
// alamat
$lapor->writeToCell(5,1,' 5. Alamat');
$lapor->writeToCell(5,2,':');
$lapor->writeToCell(5,3,ufirst(desa)." RT. ".$lpr['rt']." RW. ".$lpr['rw']);

$lapor->setBorderForCellRange($grsats, 1, 1, 5, 3);
$lapor->setBorderForCellRange($grsbwg, 5, 1, 5, 3);

/// saksi 1
$section->writeText('<b>SAKSI 1</b>',$fontdef);
$saxi1=$section->addTable();
$saxi1->addColumnsList(array(4.2,0.5,12.3));
$saxi1->addRows(5,0.4);
// nik
$saxi1->writeToCell(1,1,' 1. NIK');
$saxi1->writeToCell(1,2,':');
$saxi1->writeToCell(1,3,$data[19]);
// nama lengkap
$saxi1->writeToCell(2,1,' 2. Nama Lengkap');
$saxi1->writeToCell(2,2,':');
$saxi1->writeToCell(2,3,$sk1['nama_lengkap']);
// tanggal lahir
$saxi1->writeToCell(3,1,' 3. Tanggal Lahir');
$saxi1->writeToCell(3,2,':');
$saxi1->writeToCell(3,3,balikTanggal($sk1['tg_lahir']));
// pekerjaan
$saxi1->writeToCell(4,1,' 4. Pekerjaan');
$saxi1->writeToCell(4,2,':');
$saxi1->writeToCell(4,3,$sk1['pekerjaan']);
// alamat
$saxi1->writeToCell(5,1,' 5. Alamat');
$saxi1->writeToCell(5,2,':');
$saxi1->writeToCell(5,3,ufirst(desa)." RT. ".$sk1['rt']." RW. ".$sk1['rw']);

$saxi1->setBorderForCellRange($grsats, 1, 1, 5, 3);
$saxi1->setBorderForCellRange($grsbwg, 5, 1, 5, 3);

/// saksi 2
$section->writeText('<b>SAKSI 2</b>',$fontdef);
$saxi2=$section->addTable();
$saxi2->addColumnsList(array(4.2,0.5,12.3));
$saxi2->addRows(5,0.4);
// nik
$saxi2->writeToCell(1,1,' 1. NIK');
$saxi2->writeToCell(1,2,':');
$saxi2->writeToCell(1,3,$data[20]);
// nama lengkap
$saxi2->writeToCell(2,1,' 2. Nama Lengkap');
$saxi2->writeToCell(2,2,':');
$saxi2->writeToCell(2,3,$sk2['nama_lengkap']);
// tanggal lahir
$saxi2->writeToCell(3,1,' 3. Tanggal Lahir');
$saxi2->writeToCell(3,2,':');
$saxi2->writeToCell(3,3,balikTanggal($sk2['tg_lahir']));
// pekerjaan
$saxi2->writeToCell(4,1,' 4. Pekerjaan');
$saxi2->writeToCell(4,2,':');
$saxi2->writeToCell(4,3,$sk2['pekerjaan']);
// alamat
$saxi2->writeToCell(5,1,' 5. Alamat');
$saxi2->writeToCell(5,2,':');
$saxi2->writeToCell(5,3,ufirst(desa)." RT. ".$sk2['rt']." RW. ".$sk2['rw']);

$saxi2->setBorderForCellRange($grsats, 1, 1, 5, 3);
$saxi2->setBorderForCellRange($grsbwg, 5, 1, 5, 3);

//penadatangan
$paraf = $section->addTable();
$paraf->addColumnsList(array(5.5,5.5,6));
$paraf->addRow(0.4);	//tanggal surat
$paraf->addRow(0.4);	//kop pemaraf
$paraf->addRow(1);	//ruang paraf
$paraf->addRow(0.4);	//nama pemaraf
$paraf->addRow(0.4);	//nip  pejabat

//tanggal surat
$tgs = $paraf->getCell(1,3);
$tgs->setTextAlignment('center');
$tgs->writeText(desa.', '.$data['2']);

//nama penandatangan
/*
///yang bersangkutan
$ybs = $paraf->getCell(2,1);
$ybs->setTextAlignment('center');
$ybs->writeText('Yg Bersangkutan');

////camat
$ybs = $paraf->getCell(2,2);
$ybs->setTextAlignment('center');
$ybs->writeText('Camat '.kecamatan);
*/

////lurah
$ybs = $paraf->getCell(2,3);
$ybs->setTextAlignment('center');
$ybs->writeText($jbt);

//nama penandatangan
/*
////yang bersangkutan
$ybs = $paraf->getCell(4,1);
$ybs->setTextAlignment('center');
$ybs->writeText($warga['nama_lengkap']);

////camat
$ybs = $paraf->getCell(4,2);
$ybs->setTextAlignment('center');
$ybs->writeText('............');
*/
////lurah
$ybs = $paraf->getCell(4,3);
$ybs->setTextAlignment('center');
$ybs->writeText($ttd);

////nip
$ybs = $paraf->getCell(5,3);
$ybs->setTextAlignment('center');
$ybs->writeText($nip);

$rtf->save('./rtf/kelahiran.rtf');

echo "
<a href='./rtf/kelahiran.rtf'>Unduh Surat</a>
";

function ufirst($word)
{
	return(ucwords(strtolower($word)));
}

function balikTanggal($tgl){
	list($y,$m,$d)=explode("-",$tgl);
	return("$d / $m / $y");
}
?>
