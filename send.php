<?php
// ================= НАСТРОЙКИ =================
// --- Почта SMTP (Яндекс) ---
$yandexEmail = "roostamsalakhutdinoff@yandex.ru";
// !!! ВАЖНО: Замените 'ВАШ_ПАРОЛЬ_ПРИЛОЖЕНИЯ' на реальный пароль, полученный в Яндексе !!!
$yandexPassword = "ВАШ_ПАРОЛЬ_ПРИЛОЖЕНИЯ";
$toEmail = "roostamsalakhutdinoff@yandex.ru";
$subject = "Новая заявка с сайта КафельГранит124";

// --- Telegram ---
$telegramBotToken = "7523948551:AAFfc6JnO0CExyA0D-6PDxZU8Dej3lr1hqk";
$telegramChatId   = "1243747235";

// --- MAX (с поддержкой файлов) ---
$maxBotToken      = "f9LHodD0cOIh6VcsPNaoXvi1Zvq38sfhvWu2bwmUrFKLKgf2owOlAnBYV4TD3NwKr6EynmHKpU4iDQr01xH6";
$maxChatId        = "213451794";

// Папка для хранения файлов на сервере
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

// ========== 1. ОБРАБОТКА И СОХРАНЕНИЕ ФАЙЛОВ ==========
$uploadedFiles = [];
$firstFilePath = null; // путь к первому файлу (для Telegram)
foreach ($_FILES['attachments']['name'] as $i => $name) {
    if ($_FILES['attachments']['error'][$i] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['attachments']['tmp_name'][$i];
        $safeName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($name));
        $dest = $uploadDir . $safeName;
        if (move_uploaded_file($tmpName, $dest)) {
            $uploadedFiles[] = $dest;
            if ($firstFilePath === null) $firstFilePath = $dest;
        }
    }
}

// ========== 2. ПОДГОТОВКА ДАННЫХ ДЛЯ ОТПРАВКИ ==========
$channel = isset($_POST['channel']) ? $_POST['channel'] : '';
$name    = $_POST['name'] ?? 'Не указано';
$phone   = $_POST['phone'] ?? 'Не указан';
$cuttingTotal = $_POST['order_cutting_total'] ?? '0 ₽';
$total   = $_POST['order_total'] ?? '0 ₽';
$comment = $_POST['comment'] ?? '';

$messageText = "📢 *Новая заявка*\n👤 Имя: $name\n📞 Телефон: $phone\n💰 Резка: $cuttingTotal\n💵 Итого: $total\n" . ($comment ? "📝 Комментарий: $comment\n" : "");

// ========== 3. ОТПРАВКА ПОЧТЫ ЧЕРЕЗ SMTP (PHPMailer) ==========
require_once 'vendor/autoload.php'; // путь к автозагрузчику Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.yandex.ru';
    $mail->SMTPAuth   = true;
    $mail->Username   = $yandexEmail;
    $mail->Password   = $yandexPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL-шифрование
    $mail->Port       = 465;
    $mail->setFrom($yandexEmail, 'КафельГранит124');
    $mail->addAddress($toEmail);
    $mail->Subject = $subject;
    $mail->Body    = "Данные из формы:\n\n" . print_r($_POST, true) . "\n\n--- Прикреплённые файлы ---\n" . implode("\n", array_map('basename', $uploadedFiles));
    foreach ($uploadedFiles as $file) $mail->addAttachment($file);
    $mail->send();
    $emailSent = true;
} catch (Exception $e) {
    $emailSent = false;
    error_log("PHPMailer Error: " . $mail->ErrorInfo);
}

// ========== 4. ОТПРАВКА В TELEGRAM (текст + файл) ==========
if ($channel === 'telegram') {
    sendTelegramText($telegramBotToken, $telegramChatId, $messageText);
    if ($firstFilePath && file_exists($firstFilePath) && filesize($firstFilePath) < 10 * 1024 * 1024) {
        sendTelegramFile($telegramBotToken, $telegramChatId, $firstFilePath, "Файл к заявке от $name");
    }
}

// ========== 5. ОТПРАВКА В MAX (текст + файл) ==========
if ($channel === 'max') {
    sendToMax($maxBotToken, $maxChatId, $messageText, $firstFilePath);
}

/**
 * Загружает файл на сервер MAX и возвращает его токен.
 */
function uploadFileToMax($botToken, $filePath) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.max.ru/v1/uploads');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $botToken]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => new CURLFile($filePath)]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        return $data['token'] ?? null;
    }
    return null;
}

/**
 * Отправляет сообщение с прикреплённым файлом в MAX.
 */
function sendToMax($botToken, $chatId, $text, $filePath) {
    $attachments = [];
    if ($filePath && file_exists($filePath)) {
        $fileToken = uploadFileToMax($botToken, $filePath);
        if ($fileToken) $attachments = [['type' => 'file', 'payload' => ['token' => $fileToken]]];
    }
    $data = ['chat_id' => $chatId, 'text' => $text, 'attachments' => $attachments];
    $ch = curl_init('https://api.max.ru/v1/messages');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: Bearer ' . $botToken]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

/**
 * Отправляет текстовое сообщение в Telegram.
 */
function sendTelegramText($botToken, $chatId, $text) {
    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $data = ['chat_id' => $chatId, 'text' => $text, 'parse_mode' => 'Markdown'];
    $options = ['http' => ['header' => "Content-type: application/x-www-form-urlencoded\r\n", 'method' => 'POST', 'content' => http_build_query($data)]];
    @file_get_contents($url, false, stream_context_create($options));
}

/**
 * Отправляет файл в Telegram.
 */
function sendTelegramFile($botToken, $chatId, $filePath, $caption) {
    $url = "https://api.telegram.org/bot{$botToken}/sendDocument";
    $postFields = ['chat_id' => $chatId, 'document' => new CURLFile($filePath), 'caption' => $caption, 'parse_mode' => 'Markdown'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

http_response_code(200);
echo $emailSent ? "ok" : "email_error";
