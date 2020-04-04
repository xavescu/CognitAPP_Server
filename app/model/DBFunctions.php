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

function getAssignaturasByUserId($id) {
	$db = getCon();
	$stmt = $db->prepare("SELECT id, nombre FROM Asignatura WHERE id_usuario = ?");
	$stmt->execute(array($id));

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}