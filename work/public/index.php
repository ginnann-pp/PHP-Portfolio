<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles.css">
  <title>Document</title>
</head>

<body>
  <header>
    <h1>掲示板アプリ</h1>
  </header>

  <div class="grid">
    <div class="item">
      <img src="http://placehold.it/240x150" alt="" />
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </p>
    </div>
    <div class="item">
      <img src="http://placehold.it/240x150" alt="" />
      <p>
        Nulla pharetra porta sagittis. Mauris et suscipit diam. Sed sollicitudin, dui at vulputate varius.
      </p>
    </div>
    <div class="item">
      <img src="http://placehold.it/240x150" alt="" />
      <p>
        Integer ornare felis eu risus ultrices pharetra eu non velit.
      </p>
    </div>
    <div class="item">
      <img src="http://placehold.it/240x150" alt="" />
      <p>
        Sed a maximus dui, quis semper felis. Quisque tincidunt dapibus pellentesque.
      </p>
    </div>
    <div class="item">
      <img src="http://placehold.it/240x150" alt="" />
      <p>
        Sed eu sem lacinia, commodo orci non, vulputate neque.
      </p>
    </div>
    <div class="item">
      <img src="http://placehold.it/240x150" alt="" />
      <p>
        Integer ornare felis eu risus ultrices pharetra eu non velit.
      </p>
    </div>
    <div class="item">
      <img src="http://placehold.it/240x150" alt="" />
      <p>
        Integer ornare felis eu risus ultrices pharetra eu non velit.
      </p>
    </div>
    <div class="item">
      <img src="http://placehold.it/240x150" alt="" />
      <p>
        Integer ornare felis eu risus ultrices pharetra eu non velit.
      </p>
    </div>
  </div>

  <section class="message-form">
    <h2>新しいメッセージを投稿</h2>
    <form action="/post" method="POST">
      <label for="title">タイトル</label>
      <input type="text" id="title" name="title" required>

      <label for="content">内容</label>
      <textarea id="content" name="content" rows="4" required></textarea>

      <button type="submit">投稿</button>
    </form>
  </section>

</body>

</html>