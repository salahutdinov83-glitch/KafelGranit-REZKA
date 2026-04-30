<?php
// ================= НАСТРОЙКИ =================
$toEmail = "roostamsalakhutdinoff@yandex.ru";
$subject = "Новая заявка с сайта КафельГранит124";

// Токены для мессенджеров (из вашего исходного кода)
$telegramBotToken = "7523948551:AAFfc6JnO0CExyA0D-6PDxZU8Dej3lr1hqk";
$telegramChatId   = "1243747235";
$maxBotToken      = "f9LHodD0cOIh6VcsPNaoXvi1Zvq38sfhvWu2bwmUrFKLKgf2owOlAnBYV4TD3NwKr6EynmHKpU4iDQr01xH6";
$maxChatId        = "213451794";

// Папка для загрузки файлов
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// ========== ОБРАБОТКА ФАЙЛОВ ==========
$uploadedFiles = [];
if (isset($_FILES['attachments']) && is_array($_FILES['attachments']['name'])) {
    foreach ($_FILES['attachments']['name'] as $i => $name) {
        if ($_FILES['attachments']['error'][$i] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['attachments']['tmp_name'][$i];
            $safeName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($name));
            $dest = $uploadDir . $safeName;
            if (move_uploaded_file($tmpName, $dest)) {
                $uploadedFiles[] = $dest;
            }
        }
    }
}

// ========== ФОРМИРОВАНИЕ ТЕКСТА ПИСЬМА ==========
$message = "Данные из формы:\n\n";
foreach ($_POST as $key => $value) {
    if (is_array($value)) {
        $value = implode(', ', $value);
    }
    $message .= "$key: $value\n";
}
$message .= "\n--- Прикреплённые файлы ---\n";
if (count($uploadedFiles)) {
    foreach ($uploadedFiles as $file) {
        $message .= basename($file) . "\n";
    }
} else {
    $message .= "Файлы не загружены\n";
}

// Отправка email
$headers = "Content-Type: text/plain; charset=UTF-8\r\n";
mail($toEmail, $subject, $message, $headers);

// ========== ОТПРАВКА В МЕССЕНДЖЕРЫ (если выбран канал) ==========
$channel = isset($_POST['channel']) ? $_POST['channel'] : '';
$name    = isset($_POST['name']) ? $_POST['name'] : 'Не указано';
$phone   = isset($_POST['phone']) ? $_POST['phone'] : 'Не указан';
$cuttingTotal = isset($_POST['order_cutting_total']) ? $_POST['order_cutting_total'] : '0 ₽';
$total   = isset($_POST['order_total']) ? $_POST['order_total'] : '0 ₽';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

// Текст уведомления (краткий, без файлов, но с ссылкой на сайт)
$msg = "📢 *Новая заявка с сайта*\n";
$msg .= "👤 Имя: $name\n";
$msg .= "📞 Телефон: $phone\n";
$msg .= "💰 Стоимость резки: $cuttingTotal\n";
$msg .= "💵 Итого: $total\n";
if ($comment) {
    $msg .= "📝 Комментарий: $comment\n";
}
$msg .= "📎 Файлы сохранены на сервере. Подробности в письме.";

// Функция отправки в Telegram
function sendToTelegram($botToken, $chatId, $text) {
    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $text,
        'parse_mode' => 'Markdown'
    ];
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
            'timeout' => 5
        ]
    ];
    $context = stream_context_create($options);
    @file_get_contents($url, false, $context);
}

// Функция отправки в MAX (без файлов)
function sendToMax($botToken, $chatId, $text) {
    $url = "https://api.max.ru/v1/messages";
    $data = [
        'chat_id' => $chatId,
        'text' => $text,
        'parse_mode' => 'Markdown'
    ];
    $json = json_encode($data);
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\nAuthorization: Bearer {$botToken}\r\n",
            'method'  => 'POST',
            'content' => $json,
            'timeout' => 5
        ]
    ];
    $context = stream_context_create($options);
    @file_get_contents($url, false, $context);
}

// Отправляем только если пользователь выбрал канал
if ($channel === 'telegram') {
    sendToTelegram($telegramBotToken, $telegramChatId, $msg);
} elseif ($channel === 'max') {
    sendToMax($maxBotToken, $maxChatId, $msg);
}

// Успешный ответ браузеру
http_response_code(200);
echo "ok";
?>