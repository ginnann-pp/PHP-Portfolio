const items = document.querySelectorAll('.item');

items.forEach(item => {
    item.addEventListener('click', () => {
        threadId = item.dataset.threadId
        console.log(threadId)

        fetch('../screens/session.php', {
            method: 'POST', // メソッド指定
            headers: { 'Content-Type': 'application/json' }, // jsonを指定
            body: JSON.stringify(threadId) // json形式に変換して添付
        })
        .then(response=>response.json())
        .then(res=> {
            console.log('成功');
            console.log(res)
            window.location.href = '../screens/chat.php'
        })
        .catch(error=> {
            console.log(error);
        })
    })
})