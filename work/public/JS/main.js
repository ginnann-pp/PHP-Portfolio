const items = document.querySelectorAll('.item');


items.forEach(function (item) {
    // 取得したdiv要素にクリックイベント追加
    
    item.addEventListener('click', () => {
        let dataValue = item.getAttribute('data-thread-id');
        console.log(dataValue); //クリック確認ログ
        
        fetch('screens/log-in.php', {
            method: 'POST',
            body: 'dataValue=' + dataValue,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        
        })


    })
})