<?php
/**
 * Contact Form Handler - Telegram Bot Integration
 * This script processes the contact form submission and sends it via Telegram Bot API
 */

// ============================================
// CONFIGURATION - Replace with your actual values
// ============================================
// TODO: Replace 'YOUR_BOT_TOKEN' with your actual Telegram Bot Token
// Get your bot token from @BotFather on Telegram
define('TELEGRAM_BOT_TOKEN', 'YOUR_BOT_TOKEN');

// TODO: Replace 'YOUR_CHAT_ID' with your actual Telegram Chat ID
// You can get your chat ID by messaging @userinfobot on Telegram
define('TELEGRAM_CHAT_ID', 'YOUR_CHAT_ID');

// Telegram Bot API endpoint
define('TELEGRAM_API_URL', 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/sendMessage');

// ============================================
// VALIDATION & SANITIZATION
// ============================================

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php?status=error');
    exit;
}

// Initialize error array
$errors = [];

// Validate and sanitize Name (required)
if (empty($_POST['name'])) {
    $errors[] = 'Name is required';
} else {
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    // Additional validation: name should be at least 2 characters
    if (strlen($name) < 2) {
        $errors[] = 'Name must be at least 2 characters long';
    }
}

// Validate and sanitize Email (required)
if (empty($_POST['email'])) {
    $errors[] = 'Email is required';
} else {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
}

// Sanitize Phone (optional)
$phone = '';
if (!empty($_POST['phone'])) {
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
    $phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
}

// Validate and sanitize Message (required)
if (empty($_POST['message'])) {
    $errors[] = 'Message is required';
} else {
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    // Additional validation: message should be at least 10 characters
    if (strlen($message) < 10) {
        $errors[] = 'Message must be at least 10 characters long';
    }
}

// If there are validation errors, redirect back with error
if (!empty($errors)) {
    header('Location: contact.php?status=error');
    exit;
}

// ============================================
// FORMAT MESSAGE FOR TELEGRAM
// ============================================

$telegram_message = "🍎 *New Contact Form Submission*\n\n";
$telegram_message .= "👤 *Name:* " . $name . "\n";
$telegram_message .= "📧 *Email:* " . $email . "\n";

if (!empty($phone)) {
    $telegram_message .= "📞 *Phone:* " . $phone . "\n";
}

$telegram_message .= "\n💬 *Message:*\n" . $message . "\n";
$telegram_message .= "\n━━━━━━━━━━━━━━━━━━━━\n";
$telegram_message .= "📅 " . date('Y-m-d H:i:s') . "\n";
$telegram_message .= "🌐 Orchard Street Fresh Market";

// ============================================
// SEND MESSAGE VIA TELEGRAM BOT API
// ============================================

// Prepare the data for Telegram API
$post_data = [
    'chat_id' => TELEGRAM_CHAT_ID,
    'text' => $telegram_message,
    'parse_mode' => 'Markdown', // Allows formatting with *bold*, _italic_, etc.
    'disable_web_page_preview' => true
];

// Initialize cURL
$ch = curl_init(TELEGRAM_API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

// Execute the request
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

// ============================================
// HANDLE RESPONSE & REDIRECT
// ============================================

// Check if the request was successful
if ($http_code === 200 && $response !== false) {
    $response_data = json_decode($response, true);
    
    // Check if Telegram API returned success
    if (isset($response_data['ok']) && $response_data['ok'] === true) {
        // Success! Redirect with success status
        header('Location: contact.php?status=success');
        exit;
    } else {
        // Telegram API returned an error
        error_log('Telegram API Error: ' . json_encode($response_data));
        header('Location: contact.php?status=error');
        exit;
    }
} else {
    // cURL error or HTTP error
    error_log('cURL Error: ' . $curl_error);
    error_log('HTTP Code: ' . $http_code);
    header('Location: contact.php?status=error');
    exit;
}
?>

