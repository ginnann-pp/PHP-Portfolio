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
                console.log('成功');
                window.location.href = '../screens/chat.php'
            } else {
                console.log('あたいが違います')
            }
        })
        .catch(error => {
            console.log(error);
        });
    });
});
