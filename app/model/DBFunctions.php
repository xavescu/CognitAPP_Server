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
	$stmt = $db->prepare("SELECT id, email, nombre, username, karma FROM Usuario WHERE username LIKE ? AND password LIKE ?");
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

function deleteAsignatura($nombre,$userid) {
    $db = getCon();
    $insert = 'DELETE FROM Asignatura WHERE nombre LIKE :nombre AND id_usuario = :userid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    return $stmt->execute();
}

function updateAsignatura($nombre,$userid,$newName) {
    $db = getCon();
    $insert = 'UPDATE Asignatura SET nombre = :newName WHERE nombre LIKE :nombre AND id_usuario = :userid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);

    return $stmt->execute();
}

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

function deleteTema($nombre,$asigid) {
    $db = getCon();
    $insert = 'DELETE FROM Tema WHERE nombre LIKE :nombre AND id_asignatura = :asigid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':asigid', $asigid, PDO::PARAM_INT);

    return $stmt->execute();
}

function updateTema($nombre,$asigid,$newName) {
    $db = getCon();
    $insert = 'UPDATE Tema SET nombre = :newName WHERE nombre LIKE :nombre AND id_asignatura = :asigid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':asigid', $asigid, PDO::PARAM_INT);
    $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);

    return $stmt->execute();
}

function updateUser($userid,$newName) {
    $db = getCon();
    $insert = 'UPDATE Usuario SET username = :newName WHERE id = :userid';
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);

    return $stmt->execute();
}