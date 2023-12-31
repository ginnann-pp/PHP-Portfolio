<?php
session_start();

$raw = file_get_contents('php://input');
$data = json_decode($raw);

// レスポンス共通関数
function createResponse($message, $responsId = null)
{
    return [
        "message" => $message,
        "respons_ID" => $responsId
    ];
}

// クリック掲示板のログイン人数
function getActiveUserCount ($pdo, $threadId) {
    $sql = "SELECT COUNT(*) as count FROM users WHERE thread_id = :value";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':value', $threadId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}

if (isset($_SESSION['user-thread-id'])) {
    $userThreadId = $_SESSION['user-thread-id'];
    // 5人以下であることの判断

        if ($data->threadId == $userThreadId) {
            $response = createResponse("一致しました", $data->threadId);
            $_SESSION['threadID'] = $data->threadId;
        } else if ($userThreadId === 0) {
            $response = createResponse("あたいがゼロなので観覧モード", $userThreadId);
            $_SESSION['threadID'] = $data->threadId;
        } else {
            $response = createResponse("他の掲示板にログインしているので画面移動はできません");
        }
} else {
    $response = createResponse('ログインしていないと使えない機能です', false);
}

header('Content-Type: application/json');
echo json_encode($response);

