const items = document.querySelectorAll('.item');

items.forEach(item => {
    item.addEventListener('click', () => {
        const threadId = item.dataset.threadId; // constを追加

        fetch('../screens/session.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ threadId: threadId }) // オブジェクトとして包む
        })
        .then(response => response.json())
        .then(res => {
            if (res.respons_ID === threadId) {
                // 自分IDとクリックした掲示板IDが同じ場合
                confirm('あたいが同じなので画面移動');
                window.location.href = '../screens/chat.php'
            } else if(res.respons_ID === 0) {
                // 自分のIDが０でどこにもログインしていない場合
                if(confirm('ログインしていないがこの掲示板にはいりますか？')) {
                    window.location.href = '../screens/chat.php'
                } else {
                    return;
                }
            } else {
                alert('他の掲示板にログインしているので入れません')
            }
        })
        .catch(error => {
            console.log(error);
        });
    });
});

// // 初期値の場合userIDをDBに追加→画面移動
// function add_thread_ID(add_number) {
//     fetch('../screens/add-thread-ID.php', {
//         method: 'POST',
//         headers: { 'Content-Type': 'application/json' },
//         body: JSON.stringify({ add_number: add_number }) 
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         return response.json(); 
//     })
//     .then(res => {
//         console.log(res);
//         console.log("登録に成功しました");
//     })
//     .catch(error => {
//         console.log(error);
//     });
// }