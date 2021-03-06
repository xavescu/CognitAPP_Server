<?php

require_once('model/DBConnection.php');

function getCon() {
	$instance = DBConnection::getInstance();
	$db = $instance->getConnection();
	return $db;
}

function isValidToken($token, $user_id, $ip) {
	return false;
}

function checkCredentialsByUsername($username, $password) {
	$db = getCon();
	$stmt = $db->prepare("SELECT id, email, nombre, username, karma, tutorial FROM Usuario WHERE username LIKE ? AND password LIKE ?");
	$stmt->execute(array($username, $password));

	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function checkCredentialsByEmail($email, $password) {
	$db = getCon();
	$stmt = $db->prepare("SELECT id, email, nombre, username, karma FROM Usuario WHERE email LIKE ? AND password LIKE ?");
	$stmt->execute(array($email, $password));

	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function checkEmailExists($email) {
    $db = getCon();
    $stmt = $db->prepare("SELECT id, email, nombre, username, karma FROM Usuario WHERE email LIKE ?");
    $stmt->execute(array($email));

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function checkUserExists($username) {
    $db = getCon();
    $stmt = $db->prepare("SELECT id, email, nombre, username, karma FROM Usuario WHERE username LIKE ?");
    $stmt->execute(array($username));

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAssignaturasByUserId($id) {
	$db = getCon();
	$stmt = $db->prepare("SELECT id, nombre FROM Asignatura WHERE id_usuario = ?");
	$stmt->execute(array($id));

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertUser($email,$nombre,$username,$password,$karma) {
    $db = getCon();
    $insert = 'INSERT INTO Usuario(email,nombre,username,password,karma) VALUES' . '(:email,:nombre,:username,:password,:karma)';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':karma', $karma, PDO::PARAM_INT);

    return $stmt->execute();
}

function insertAsignatura($nombre,$userid) {
    $db = getCon();
    $insert = 'INSERT INTO Asignatura(nombre,id_usuario) VALUES' . '(:nombre,:userid)';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    return $stmt->execute();
}

function deleteAsignatura($id) {
    $db = getCon();
    $insert = 'DELETE FROM Asignatura WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

/* ASIGNATURA */
function updateAsignatura($id, $nombre) {
    $db = getCon();
    $insert = 'UPDATE Asignatura SET nombre = :nombre WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/*    */

function insertTema($nombre,$assigid) {
    $db = getCon();
    $insert = 'INSERT INTO Tema(nombre,id_asignatura) VALUES' . '(:nombre,:assigid)';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':assigid', $assigid, PDO::PARAM_INT);

    return $stmt->execute();
}

function getTemasByAssignaturaId($id) {
    $db = getCon();
    $stmt = $db->prepare("SELECT id, nombre FROM Tema WHERE id_asignatura = ?");
    $stmt->execute(array($id));

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteTema($id) {
    $db = getCon();
    $insert = 'DELETE FROM Tema WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function existsTema($id, $nombre) {
    $db = getCon();
    $select = 'SELECT * FROM Tema WHERE nombre LIKE :nombre AND id_asignatura = (SELECT id_asignatura FROM Tema WHERE id = :id)';
    $stmt = $db->prepare($select);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return !empty($stmt->fetch(PDO::FETCH_ASSOC));
}

function existsAsignatura($id, $nombre) {
    $db = getCon();
    $select = 'SELECT * FROM Asignatura WHERE nombre LIKE :nombre AND id_usuario = (SELECT id_usuario FROM Asignatura WHERE id = :id)';
    $stmt = $db->prepare($select);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return !empty($stmt->fetch(PDO::FETCH_ASSOC));
}

function existsResumen($id, $nombre) {
    $db = getCon();
    $select = 'SELECT * FROM Documento WHERE nombre LIKE :nombre AND id_tema = (SELECT id_tema FROM Documento WHERE id = :id)';
    $stmt = $db->prepare($select);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return !empty($stmt->fetch(PDO::FETCH_ASSOC));
}

function updateTemaNombre($id, $nombre) {
    $db = getCon();
    $insert = 'UPDATE Tema SET nombre = :nombre WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function updateTemaSubject($id, $subject) {
    $db = getCon();
    $insert = 'UPDATE Tema SET id_asignatura = :subject WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':subject', $subject, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function updateUserUsername($userid,$newName) {
    $db = getCon();
    $insert = 'UPDATE Usuario SET username = :newName WHERE id = :userid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);

    return $stmt->execute();
}

function updateUserEmail($userid,$newemail) {
    $db = getCon();
    $insert = 'UPDATE Usuario SET email = :newemail WHERE id = :userid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->bindParam(':newemail', $newemail, PDO::PARAM_STR);

    return $stmt->execute();
}

function updateUserPassword($userid,$newpass) {
    $db = getCon();
    $insert = 'UPDATE Usuario SET password = :newpass WHERE id = :userid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->bindParam(':newpass', $newpass, PDO::PARAM_STR);

    return $stmt->execute();
}

function updateUserNombre($userid,$newnombre) {
    $db = getCon();
    $insert = 'UPDATE Usuario SET nombre = :newnombre WHERE id = :userid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->bindParam(':newnombre', $newnombre, PDO::PARAM_STR);

    return $stmt->execute();
}

function insertDocumento($idtema, $nombre) {
    $db = getCon();
    $insert = 'INSERT INTO Documento(nombre,id_tema) VALUES' . '(:nombre,:idtema)';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':idtema', $idtema, PDO::PARAM_INT);

    $stmt->execute();

    $select = 'SELECT * FROM Documento WHERE id_tema = :idtema AND nombre = :nombre';
    $stmt = $db->prepare($select);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':idtema', $idtema, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertResumen($iddocumento, $texto, $tipo, $foto) {
    $db = getCon();
    $insert = 'INSERT INTO Resumen(id_documento,texto, tipo, foto) VALUES' . '(:iddocumento,:text, :tipo, :foto)';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':iddocumento', $iddocumento, PDO::PARAM_STR);
    $stmt->bindParam(':text', $texto, PDO::PARAM_STR);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);
    $stmt->bindParam(':foto', $foto, PDO::PARAM_INT);

    return $stmt->execute();
}

function deleteDocumento($nombre,$temaid) {
    $db = getCon();
    $insert = 'DELETE FROM Documento WHERE nombre LIKE :nombre AND id_tema = :temaid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':temaid', $temaid, PDO::PARAM_INT);

    return $stmt->execute();
}

function getResumenesByTemaId($id) {
    $db = getCon();
    $stmt = $db->prepare("SELECT D.id AS id, D.nombre AS nombre, R.texto AS texto, R.tipo AS tipo, R.foto AS foto FROM Documento D JOIN Resumen R ON D.id = R.id_documento WHERE D.id_tema = ? AND R.tipo = 0");
    $stmt->execute(array($id));

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getResumen($id) {
    $db = getCon();
    $stmt = $db->prepare("SELECT D.id AS id, D.nombre AS nombre, R.texto AS texto, R.tipo AS tipo, R.foto AS foto FROM Documento D JOIN Resumen R ON D.id = R.id_documento WHERE D.id = ?");
    $stmt->execute(array($id));

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteResumen($id_doc) {
    $db = getCon();
    $delete = 'DELETE FROM Resumen WHERE id_documento = :id_doc';
    $stmt = $db->prepare($delete);
    $stmt->bindParam(':id_doc', $id_doc, PDO::PARAM_INT);

    $stmt->execute();

    $delete = 'DELETE FROM Documento WHERE id = :id_doc';
    $stmt = $db->prepare($delete);
    $stmt->bindParam(':id_doc', $id_doc, PDO::PARAM_INT);

    return $stmt->execute();
}

/* RESUMEN/EXAMEN */
function updateResumenNombre($id, $nombre) {
    $db = getCon();

    $insert = 'UPDATE Documento SET nombre = :nombre WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);;

    return $stmt->execute();
}

function updateResumenTexto($id, $texto) {
    $db = getCon();

    $insert = 'UPDATE Resumen SET texto = :texto WHERE id_documento = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':texto', $texto, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);;

    return $stmt->execute();
}

function updateResumenTipo($id, $tipo) {
    $db = getCon();

    $insert = 'UPDATE Resumen SET tipo = :tipo WHERE id_documento = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);;

    return $stmt->execute();
}

function updateResumenTema($id, $tema) {
    $db = getCon();

    $insert = 'UPDATE Documento SET id_tema = :tema WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':tema', $tema, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);;

    return $stmt->execute();
}

/*    */

function insertExamen($iddocumento, $texto) {
    $db = getCon();
    $insert = 'INSERT INTO Resumen(id_documento,texto, tipo) VALUES' . '(:iddocumento,:text, 1)';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':iddocumento', $iddocumento, PDO::PARAM_STR);
    $stmt->bindParam(':text', $texto, PDO::PARAM_STR);

    return $stmt->execute();
}

function getExamenesByTemaId($id) {
    $db = getCon();
    $stmt = $db->prepare("SELECT D.id AS id_documento, D.nombre AS nombre, R.texto AS texto FROM Documento D JOIN Resumen R ON D.id = R.id_documento WHERE D.id_tema = ? AND R.tipo = 1");
    $stmt->execute(array($id));

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function disableTutorial($id) {
    $db = getCon();

    $insert = 'UPDATE Usuario SET tutorial = 0 WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);;

    return $stmt->execute();
}

function insertFita($id, $nombre, $descripcion, $fecha_limite, $tipo_recordatorio) {
    $db = getCon();
    $insert = 'INSERT INTO Fita(id_usuario, nombre, descripcion, fecha_limite, tipo_recordatorio) VALUES' . '(:idusuario, :nombre, :descripcion, :fechalimite, :tiporecordatorio)';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':idusuario', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':fechalimite', $fecha_limite, PDO::PARAM_STR);
    $stmt->bindParam(':tiporecordatorio', $tipo_recordatorio, PDO::PARAM_INT);

    return $stmt->execute();
}

function getFites($id) {
    $db = getCon();
    $stmt = $db->prepare("SELECT id, nombre, descripcion, hecho, fecha_limite, tipo_recordatorio FROM Fita WHERE id_usuario = ?");
    $stmt->execute(array($id));

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function completarFita($id) {
    $db = getCon();
    $insert = 'UPDATE Fita SET hecho = 1 WHERE id = :id';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

function compartir($id, $usuario) {
    $db = getCon();

    $val = '';
    for( $i=0; $i<6; $i++ ) {
       $val .= chr( rand( 65, 90 ) );
    }

    $insert = 'INSERT INTO Compartido (id_documento, id_usuario, codigo) VALUES (:id, (SELECT id FROM Usuario WHERE username = :usuario), :codigo)';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':codigo', $val, PDO::PARAM_STR);

    $stmt->execute();   
    return $val; 
}

function getDocId($code) {
    $db = getCon();
    $stmt = $db->prepare("SELECT id_documento from Compartido WHERE codigo = :codigo");
    $stmt->bindParam(':codigo', $code, PDO::PARAM_STR);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($results);
    return 1;
}

/* no es una db funcion pero la poso aqui tambe */

function returnfile($location, $name) {
    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
    header("Cache-Control: public"); // needed for internet explorer
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length:".filesize($location));
    header("Content-Disposition: attachment; filename=".$name.".pdf");
    readfile($location);
    die();
}

function generarfile($id) {
    $resumen = getResumen($id);
    file_put_contents("/home/pi/pdf/$id.tex", "\\documentclass{article}\\begin{document}\\LARGE{\\textbf{".$resumen[0]['nombre']."}}\\\\\\\\".$resumen[0]['texto']."\\end{document}");
    shell_exec("cd /home/pi/pdf && pdflatex $id.tex");
}