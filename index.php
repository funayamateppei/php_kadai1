<?php

// $str = '';


// $datafile = fopen('../data/chatdata.csv', 'r');
// flock($datafile, LOCK_EX);

// // もしファイルが空じゃなければ実行
// if (!empty($datafile)) {
//   if ($datafile) {
//     while ($line = fgetcsv($datafile)) {
//       $str .= "
//         <div class='item'>
//           <p class='name'>{$line[0]}</p>
//           <p class='text'> {$line[1]}</p>
//           <p class='time'>{$line[2]}</p>
//         </div>
//         ";
//     }
//   }
// }

// flock($datafile, LOCK_UN);
// fclose($datafile);

?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/chat.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>line</title>
</head>

<body>
  <header>

  </header>

  <div id="display">
    <!-- ここに表示していく -->
  </div>

  <form action="./php/chat_create.php" method="POST">
    <input type="name" name="name" id="name" placeholder="name">
    <input type="text" name="text" id="text" placeholder="text">
    <button id="submitBtn"><i class="fa-solid fa-comment"></i></button>
  </form>

  <script>
    let array = [];
    let html = [];

    function checkMessage() {
      console.log('hoge');
      $.ajax({
          type: 'post',
          url: './data/chatdata.csv'
        })
        .then(
          function(data) {
            array = [];
            html = [];
            console.log(data);
            // 改行 で切り分けて配列に収納
            let datalist = data.split(/\n/);
            console.log(datalist);
            // data１つ１つを , で切り分けて配列に収納
            datalist.map((x, i) => {
              const datalist2 = x.split(',');
              return array.push(datalist2);
            })
            console.log(array)
            // 表示する形で配列に入れていく
            // 空白の分までまわさないように注意！
            for (let i = 0; i < array.length - 1; i++) {
              html.push(`
              <div class='item'>
                <p class='name'>${array[i][0]}</p>
                <p class='text'>${array[i][1]}</p>
                <p class='time'>${array[i][2]}</p>
              </div>
            `)
            }
            console.log(html);
            $('#display').html(html);
          },
          // 失敗したときにはERRORと表示
          function() {
            $('#display').html('ERROR');
          }
        )
    }

    $(document).ready(function() {
      // 最初に関数を１回呼び出しておく
      checkMessage();
      // タイマー起動（chekMessage関数を３秒間隔で呼び出す）
      setInterval(() => {
        checkMessage()
      }, 3000);
    });
  </script>

</body>

</html>