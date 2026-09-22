<?php

class Register
{
    public static function registerUser()
    {
        if (!isset($_POST['save'])) {
            return [false, 'Vormi andmed puuduvad'];
        }

        $username = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm'] ?? '';

        if ($username == '') {
            return [false, 'Sisesta kasutajanimi'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [false, 'E-posti aadress ei ole korrektne'];
        }

        if (mb_strlen($password) < 6) {
            return [false, 'Parool peab olema vähemalt 6 tähemärki'];
        }

        if ($password !== $confirm) {
            return [false, 'Paroolid ei ühti'];
        }

        $db = new Database();

        $existingUser = $db->getOne(
            "SELECT id FROM users WHERE email = ?",
            [$email]
        );

        if ($existingUser) {
            return [false, 'Selle e-posti aadressiga kasutaja on juba olemas'];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users
                  (username, email, password, status, registration_date, pass)
                  VALUES (?, ?, ?, 'user', CURDATE(), '')";

        $result = $db->executeRun(
            $query,
            [$username, $email, $passwordHash]
        );

        if ($result) {
            return [true, 'Kasutaja on lisatud'];
        }

        return [false, 'Kasutaja lisamine ebaõnnestus'];
    }
}