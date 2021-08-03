<?php

class Koneksi {

    private $host = "localhost";
    private $user = "aisx1277_root";
    private $password = "lagis3nt0s4";
    private $db = "aisx1277_floyd";

    public function connect() {
        return mysqli_connect($this->host, $this->user, $this->password, $this->db);
    }

}

class graph { // class graph digunakan untuk pengolahan data sebelum dikirim ke class fw.class.php (convert to matrix data first)

    public $koneksi;

    public function __construct() {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->connect();
    }

    private function listAsal() {
        $link = $this->koneksi;
        $sql = "select DISTINCT (awal) from `graph` order BY awal ASC";
        $result = mysqli_query($link, $sql);
        $arr = [];
        while ($data = mysqli_fetch_assoc($result)) {
            array_push($arr, $data['awal']);
        }
        return $arr;
    }

    private function listTujuan() {
        $link = $this->koneksi;
        $sql = "select DISTINCT (akhir) from `graph` order BY akhir ASC LIMIT 83";
        $result = mysqli_query($link, $sql);
        $arr = [];
        while ($data = mysqli_fetch_assoc($result)) {
            array_push($arr, $data['akhir']);
        }
        // var_dump($arr);
        return $arr;
    }

    private function listJarak() {
        $link = $this->koneksi;
        $sql = "select * from `graph` order by awal ASC";
        $result = mysqli_query($link, $sql);
        $arr = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $dataJarak = [];
            $dataJarak['awal'] = $data['awal'];
            $dataJarak['akhir'] = $data['akhir'];
            $dataJarak['jarak'] = $data['jarak'];
            array_push($arr, $dataJarak);
        }
        return $arr;
    }

    public function makeGraph() {
        $listAsal = $this->listAsal();
        $listTujuan = $this->listTujuan();
        $listJarak = $this->listJarak();
        $graph = [];
        for ($i = 0; $i < count($listAsal); $i++) {
            $mRow = [];
            for ($j = 0; $j < count($listTujuan); $j++) {
                $jarak = 0;
                for ($k = 0; $k < count($listJarak); $k++) {
                    if ($listJarak[$k]['awal'] == $listAsal[$i] and $listJarak[$k]['akhir'] == $listTujuan[$j]) {
                        $jarak = $listJarak[$k]['jarak'];
                        break;
                    } else {
                        $jarak = 0;
                    }
                }
                array_push($mRow, $jarak);
            }
            array_push($graph, $mRow);
        }
        return $graph;
    }

    public function makeNodes() {
        return $this->listTujuan();
    }

    public function getNodeDetail($node) {
        $link = $this->koneksi;
        $query = "select * from vertex where node=$node";
        $result = mysqli_query($link, $query);
        return $result;
    }

}

class NodeMakerClass { // class main digunakan di halaman pembuat maker / nodemaker

    public $koneksi;

    public function __construct() {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->connect();
    }

//load vertex from database
    public function loadMarker() {
        $link = $this->koneksi;
        $query = "select * from vertex order by node ASC";
        $result = mysqli_query($link, $query);
        return $result;
    }

//load graph from database
    public function loadGraph() {
        $link = $this->koneksi;
        $query = "select * from graph GROUP BY arah ORDER BY awal ASC";
        $result = mysqli_query($link, $query);
        return $result;
    }

    public function ResetDatabase() {
        $link = $this->koneksi;
        $query = "truncate table `vertex`;truncate table `graph`;";
        $result = mysqli_multi_query($link, $query);
        return $result;
    }

}

class FrontEndClass { //class FrontEnd digunakan di halaman Home/ halaman utama

    public $koneksi;

    public function __construct() {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->connect();
    }

    public function hotelDetail($id) {
        $link = $this->koneksi;
        $sql = "
        SELECT
            *
        FROM
            vertex
        LEFT JOIN tempat ON tempat.id_node = vertex.id
        WHERE
            vertex.destination = 'true'
        AND vertex.id = $id
        ORDER 
            BY vertex.nama ASC";
        $result = mysqli_query($link, $sql);
        return $result;
    }

    public function getTempat() {
        $link = $this->koneksi;
        $sql = "
        SELECT
            *
        FROM
            vertex
        LEFT JOIN tempat ON tempat.id_node = vertex.id
        WHERE
            vertex.destination = 'true'
            and id_node<>''
        ORDER 
            BY vertex.nama ASC";
        $result = mysqli_query($link, $sql);
        return $result;
    }
    public function GetNode()
    {
        $link = $this->koneksi;
        $sql = "select * from vertex where destination = 'TRUE'";
        $result = mysqli_query($link,$sql);
        return $result;
    }

    public function getAsal() {
        $link = $this->koneksi;
        $sql = "select * from vertex where source='true' order BY nama ASC";
        $result = mysqli_query($link, $sql);
        return $result;
    }

    public function getTujuan() {
        $link = $this->koneksi;
        $sql = "SELECT
	vtx.id AS id_vertex,
	vtx.node,
	vtx.nama
FROM
	vertex AS vtx
LEFT JOIN tempat AS tpt ON tpt.id_node = vtx.id
WHERE
	vtx.destination = 'true'
and tpt.id_node<>''
ORDER BY
	vtx.nama ASC";
        $result = mysqli_query($link, $sql);
        return $result;
    }

//    public function getJarak($awal) {
//        $link = $this->koneksi;
//        $sql = "select * from `graph` where awal ='$awal' and jarak>0";
//        $result = mysqli_query($link, $sql);
//        return $result;
//    }
//    public function getNode($param) {
//        $link = $this->koneksi;
//        $query = "select * from `vertex` where node=$param";
//        $result = mysqli_query($link, $query);
//        return $result;
//    }
    public function TempatTujuanLocation($loc) {
        $link = $this->koneksi;
        $sql = "SELECT
tempat.id,
tempat.id_node,
tempat.alamat,
tempat.deskripsi,
tempat.img,
tempat.telp,
vertex.nama
FROM
tempat
JOIN vertex ON vertex.id = tempat.id_node
WHERE
tempat.alamat LIKE '%$loc%'
";
        $result = mysqli_query($link, $sql);
        return $result;
    }

}

class BackEndClass { // class ini digunakan untuk management data di bagian ADMIN page

    public $koneksi;

    public function __construct() {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->connect();
    }

    public function getTempat() {
        $data = [];
        $link = $this->koneksi;
        $sql = "
        SELECT
	vtx.id AS id_vertex,
	vtx.node,
	vtx.nama,
	vtx.thumb,
	tpt.id AS id_tempat,
	tpt.id_node,
	tpt.alamat,
	tpt.deskripsi,
	tpt.telp,
	tpt.img
FROM
	vertex AS vtx
LEFT JOIN tempat AS tpt ON tpt.id_node = vtx.id
WHERE
	vtx.destination = 'true'
ORDER BY
	vtx.nama ASC";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function insertTempat($id_node, $alamat, $deskripsi, $telp, $img) {
        $link = $this->koneksi;
        if ($img == '') {
            $query = "insert into tempat (id_node,alamat,deskripsi,telp) VALUES ($id_node,'$alamat','$deskripsi','$telp')";
        } else {
            $query = "insert into tempat (id_node,alamat,deskripsi,img,telp) VALUES ($id_node,'$alamat','$deskripsi','$img','$telp')";
        }
        $result = mysqli_query($link, $query);
        return $result;
    }

    public function editTempat($id_node, $alamat, $deskripsi, $telp, $img) {
        $link = $this->koneksi;
        if ($img == '') {
            $query = "update tempat set alamat='$alamat',telp='$telp',deskripsi='$deskripsi' where id_node=$id_node";
        } else {
            $query = "update tempat set alamat='$alamat',telp='$telp',deskripsi='$deskripsi',img='$img' where id_node=$id_node";
        }
        $result = mysqli_query($link, $query);
        return $result;
    }

    public function editVertex($id_vertex, $new_nama) {
        $link = $this->koneksi;
        $query = "update vertex set nama='$new_nama' where id=$id_vertex";
        $result = mysqli_query($link, $query);
        return $result;
    }

    public function getVertex() {
        $data = [];
        $link = $this->koneksi;
//        $query = "select * from vertex where destination<>'true' order by source DESC";
        $query = "select * from vertex order by destination DESC";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function editVertexByForm($node, $new_nama, $asal) {
        $link = $this->koneksi;
        $query = "update vertex set nama='$new_nama',source='$asal' where node=$node";
        $result = mysqli_query($link, $query);
        return $result;
    }

    public function getUserProfile() {
        $profile = [];
        $link = $this->koneksi;
        $query = "SELECT USER
	.nama,
	USER.email,
	USER.nim,
	USER.universitas,
	USER.prodi,
	USER.jenjang,
	USER.img 
FROM
USER";
        $result = mysqli_query($link, $query);
        while ($data = mysqli_fetch_assoc($result)) {
            array_push($profile, $data);
        }
        return $profile;
    }
    public function GetNode()
    {
        $link = $this->koneksi;
        $sql = "select * from vertex where destination = 'TRUE'";
        $result = mysqli_query($link,$sql);
        return $result;
    }


}

class users { // class ini digunakan untuk management user, seperti login, session check, edit profil dll.

    public $koneksi;

    public function __construct() {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->connect();
    }

    public function login($email, $password) {
        $nama = '';
        $chipperPass = '';
        $users = [];
        require_once 'AES.class.php';
        $link = $this->koneksi;
        $sql = "select * from `user` where email = '" . $email . "' limit 1";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // $chipperPass = $row['password'];
            $nama = $row['nama'];
            $nim = $row['nim'];
            $universitas = $row['universitas'];
            $prodi = $row['prodi'];
            $jenjang = $row['jenjang'];
            $img = $row['img'];
            $id = $row['id'];
            // $imputText = $chipperPass;
            // $imputKey = "masterkey256encr";
            // $blockSize = 256;
            // $aes = new AES($imputText, $imputKey, $blockSize);
            // $dec = $aes->decrypt();

            // if ($dec == $password) {
                $users['logged'] = true;
                $this->sessionRegister(true, $nama, $email, $nim, $universitas, $prodi, $jenjang, $img, $id);
                return $users;
            // } else {
            //     $users['logged'] = false;
            //     return $users;
            // }
        } else {
            $users['logged'] = false;
            return $users;
        }
    }

    private function sessionRegister($logged, $nama, $email, $nim, $universitas, $prodi, $jenjang, $img, $id) {
        session_start();
        $_SESSION['logged'] = $logged;
        $_SESSION['email'] = $email;
        $_SESSION['nama'] = $nama;
        $_SESSION['nim'] = $nim;
        $_SESSION['universitas'] = $universitas;
        $_SESSION['prodi'] = $prodi;
        $_SESSION['jenjang'] = $jenjang;
        $_SESSION['img'] = $img;
        $_SESSION['id'] = $id;
    }

    public function sessionCheck() {
        $sessions = [];
        session_start();
        $nama = &$_SESSION['nama'];
        $logged = &$_SESSION['logged'];
        $email = &$_SESSION['email'];
        $nim = &$_SESSION['nim'];
        $universitas = &$_SESSION['universitas'];
        $prodi = &$_SESSION['prodi'];
        $jenjang = &$_SESSION['jenjang'];
        $img = &$_SESSION['img'];
        $id = &$_SESSION['id'];

        if (isset($nama) && isset($logged) && isset($email)) {
            $sessions['logged'] = $logged;
            $sessions['nama'] = $nama;
            $sessions['email'] = $email;
            $sessions['nim'] = $nim;
            $sessions['universitas'] = $universitas;
            $sessions['prodi'] = $prodi;
            $sessions['jenjang'] = $jenjang;
            $sessions['img'] = $img;
            $sessions['id'] = $id;

            return $sessions;
        } else {
            $sessions['logged'] = false;
            return $sessions;
        }
    }

    public function myProfile() {
        $link = $this->koneksi;
        $sql = "select * from `user` where akses = 'admin' limit 1";
        $result = mysqli_query($link, $sql);
        return $result;
    }

    public function editProfile($nama, $email, $password, $nim, $universitas, $prodi, $jenjang, $img, $id) {
        $link = $this->koneksi;
        if ($img == 'none') {
            $sql = "update `user` set nama = '$nama', email = '$email', password = '$password', "
                    . "nim = '$nim', universitas = '$universitas', prodi = '$prodi', jenjang = '$jenjang' where id = $id";
        } else {
            $sql = "update `user` set nama = '$nama', email = '$email', password = '$password', "
                    . "nim = '$nim', universitas = '$universitas', prodi = '$prodi', jenjang = '$jenjang', img = '$img' where id = $id";
        }
        $result = mysqli_query($link, $sql);
        return $result;
    }

}
